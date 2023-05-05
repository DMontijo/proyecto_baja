<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\ConexionesDBModel;
use App\Models\DenunciantesModel;
use App\Models\FolioModel;

class CambiosExpedienteCronJob extends BaseController
{
    private $_folioModel;
    private $_denunciantesModel;
    private $_conexionesDBModel;
    private $protocol;
    private $ip;
    private $endpoint;
    function __construct()
    {
        //Models
        $this->_folioModel = new FolioModel();
        $this->_denunciantesModel = new DenunciantesModel();
        $this->_conexionesDBModel = new ConexionesDBModel();
        $this->protocol = 'https://';
        $this->ip = "ws.fgebc.gob.mx";
        $this->endpoint = $this->protocol . $this->ip . '/webServiceVD';
    }


    public function ejecutar_tarea()
    {

        $folioInfo = $this->_folioModel->asObject()->join('DENUNCIANTES', 'FOLIO.DENUNCIANTEID = DENUNCIANTES.DENUNCIANTEID')->where('TIPODENUNCIA', 'VD')->findAll();

        foreach ($folioInfo as $key => $folio) {
            $municipio = $folio->MUNICIPIOASIGNADOID != NULL ? $folio->MUNICIPIOASIGNADOID : $folio->INSTITUCIONREMISIONMUNICIPIOID;

            $info = $this->_getInfo($folio->EXPEDIENTEID, $municipio);
            if ($info != null) {
                $correo = $this->_sendEmailCambioExpediente($folio->CORREO, $folio->EXPEDIENTEID, $info->OFICINADESCR, $info->ESTADOJURIDICODESCR);
                if ($correo) {
                    $update = $this->_updateInfo($folio->EXPEDIENTEID, $municipio);
                }
            }
        }
    }
    private function _getInfo($expedienteID, $municipio)
    {
        $function = '/cambiosExpediente.php?process=getInfo';
        $endpoint = $this->endpoint . $function;
        $conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();


        $data['userDB'] = "DBO";
        $data['pwdDB'] = "dba0wner";
        $data['instance'] = "172.16.105.56/PGJETIJ";
        $data['schema'] = "DBO";

        
        // $data['userDB'] = $conexion->USER;
        // $data['pwdDB'] = $conexion->PASSWORD;
        // $data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
        // $data['schema'] = $conexion->SCHEMA;

        $data['EXPEDIENTEID'] = $expedienteID;
        return $this->_curlPostDataEncrypt($endpoint, $data);
    }
    private function _updateInfo($expedienteID, $municipio)
    {
        $function = '/cambiosExpediente.php?process=updateInfo';
        $endpoint = $this->endpoint . $function;
        $conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();

        $data['userDB'] = $conexion->USER;
        $data['pwdDB'] = $conexion->PASSWORD;
        $data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
        $data['schema'] = $conexion->SCHEMA;
        $data['EXPEDIENTEID'] = $expedienteID;
        $data['ESTATUS_CAMBIO'] = "PROCESADO";

        return $this->_curlPostDataEncrypt($endpoint, $data);
    }

    private function _sendEmailCambioExpediente($to, $expedienteId, $oficina, $estadojuridico)
    {
        $folioM = $this->_folioModel->asObject()->where('EXPEDIENTEID', $expedienteId)->first();
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setSubject('Cambio expediente');
        $body = view('email_template/update_info_email_template.php', ['expediente' => $expedienteId, 'oficina'=> $oficina, 'estadojuridico'=>$estadojuridico]);
        $email->setMessage($body);
        $email->setAltMessage('El expediente se ha cambio de estado y se encuentra en:' . $estadojuridico .'y se esta atendiendo en la oficina:' . $oficina);

        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }

    private function _curlPostDataEncrypt($endpoint, $data)
    {
        // var_dump($data);exit;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_encriptar(json_encode($data), KEY_128));
        $headers = array(
            'Content-Type: application/json',
            'Access-Control-Allow-Origin: *',
            'Access-Control-Allow-Credentials: true',
            'Access-Control-Allow-Headers: Content-Type',
            'Hash-API: ' . password_hash(TOKEN_API, PASSWORD_BCRYPT),
            'Key: ' . KEY_128
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);

        if ($result === false) {
            $result = "{
                'status' => 401,
                'error' => 'Curl failed: '" . curl_error($ch) . "
            }";
        }
        curl_close($ch);
        // var_dump($data);
        // var_dump($result);exit;
        // return $result;
        return json_decode($result);
    }

    private function _encriptar($plaintext, $key128)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-128-cbc'));
        $cipherText = openssl_encrypt($plaintext, 'AES-128-CBC', hex2bin($key128), 1, $iv);
        return base64_encode($iv . $cipherText);
    }
}
