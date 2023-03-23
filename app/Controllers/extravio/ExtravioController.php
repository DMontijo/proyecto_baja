<?php

namespace App\Controllers\extravio;

use App\Controllers\BaseController;

use App\Models\PersonaNacionalidadModel;
use App\Models\PersonaEstadoCivilModel;
use App\Models\PersonaIdiomaModel;
use App\Models\EstadosModel;
use App\Models\MunicipiosModel;
use App\Models\LocalidadesModel;
use App\Models\ColoniasModel;
use App\Models\PersonaTipoIdentificacionModel;
use App\Models\PaisesModel;
use App\Models\HechoClasificacionLugarModel;
use App\Models\FolioModel;
use App\Models\DenunciantesModel;
use App\Models\ConstanciaExtravioModel;
use App\Models\UsuariosModel;
use App\Models\HechoLugarModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\SesionesDenunciantesModel;

class ExtravioController extends BaseController
{

	private $_denunciantesModel;
	private $_nacionalidadModel;
	private $_estadosCivilesModel;
	private $_personaIdiomaModel;
	private $_estadosModel;
	private $_municipiosModel;
	private $_localidadesModel;
	private $_coloniasModel;
	private $_tipoIdentificacionModel;
	private $_paisesModel;
	private $_clasificacionLugarModel;
	private $_folioModel;
	private $_constanciaExtravioModel;
	private $_usuariosModel;
	private $_hechoLugarModel;
	private $db;
	private $_sesionesDenunciantesModel;

	function __construct()
	{
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_nacionalidadModel = new PersonaNacionalidadModel();
		$this->_estadosCivilesModel = new PersonaEstadoCivilModel();
		$this->_personaIdiomaModel = new PersonaIdiomaModel();
		$this->_estadosModel = new EstadosModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_localidadesModel = new LocalidadesModel();
		$this->_coloniasModel = new ColoniasModel();
		$this->_tipoIdentificacionModel = new PersonaTipoIdentificacionModel();
		$this->_paisesModel = new PaisesModel();
		$this->_clasificacionLugarModel = new HechoClasificacionLugarModel();
		$this->_folioModel = new FolioModel();
		$this->_constanciaExtravioModel = new ConstanciaExtravioModel();
		$this->_usuariosModel = new UsuariosModel();
		$this->_hechoLugarModel = new HechoLugarModel();
		$this->_sesionesDenunciantesModel = new SesionesDenunciantesModel();

		$this->db = \Config\Database::connect();
	}

	public function index()
	{
		if ($this->_isAuth()) {
			return redirect()->to(base_url('/constancia_extravio/dashboard'));
		} else {
			session()->destroy;
			$this->_loadView('Login', [], 'index');
		}
	}
	public function register()
	{
		$this->_loadView('Nuevo solicitante', [], 'register');
	}

	public function login_auth()
	{
		$session = session();
		$email = $this->request->getPost('correo');
		$password = $this->request->getPost('password');
		$email = trim($email);
		$password = trim($password);
		$data = $this->_denunciantesModel->where('CORREO', $email)->first();
		if ($data) {
			$control_session = $this->_sesionesDenunciantesModel->asObject()->where('ID_DENUNCIANTE', $data['DENUNCIANTEID'])->where('ACTIVO', 1)->first();
			if ($control_session) {
				return redirect()->to(base_url('/denuncia'))->with('message_session', 'Ya tienes sesiones activas, cierralas para continuar.')->with('id',  $data['DENUNCIANTEID']);
			}
			if (validatePassword($password, $data['PASSWORD'])) {
				$data['logged_in'] = TRUE;
				$data['type'] = 'user_constancias';
				$data['uuid'] = uniqid();

				$session->set($data);
				$agent = $this->request->getUserAgent();

				$sesion_data = [
					'ID' => $data['uuid'],
					'ID_DENUNCIANTE' => $data['DENUNCIANTEID'],
					'IP_DENUNCIANTE' => $this->_get_client_ip(),
					'IP_PUBLICA' => $this->_get_public_ip(),
					'DENUNCIANTE_HTTP' => $agent->getBrowser(),
					'DENUNCIANTE_SO' => $agent->getPlatform(),
					'DENUNCIANTE_MOBILE' => $agent->isMobile() ? 1 : 0,
					'ACTIVO' => 1,
				];

				$this->_sesionesDenunciantesModel->insert($sesion_data);
				return redirect()->to(base_url('/constancia_extravio/dashboard'));
			} else {
				$session->setFlashdata('message', 'La contraseña es incorrecta, intentalo de nuevo o da clic en olvide mi contraseña.');
				return redirect()->back();
			}
		} else {
			$session->setFlashdata('message', 'El correo no está registrado, registrate para continuar.');
			return redirect()->back();
		}
	}

	public function create()
	{

		$password = $this->_generatePassword(6);

		$data = [
			'NOMBRE' => $this->request->getPost('nombre'),
			'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
			'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
			'CORREO' => $this->request->getPost('correo'),
			'PASSWORD' => hashPassword($password),
			'TELEFONO' => $this->request->getPost('telefono'),
			'TELEFONO2' => $this->request->getPost('telefono2'),
			'CODIGO_PAIS' => $this->request->getPost('codigo_pais'),
			'CODIGO_PAIS2' => $this->request->getPost('codigo_pais_2'),
			'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento'),
			'SEXO' => $this->request->getPost('sexo'),
			'TIPO' => 2,
		];

		if ($this->validate(['correo' => 'required|is_unique[DENUNCIANTES.CORREO]'])) {
			$dataApi2 = [
				'NOMBRE' => $this->request->getPost('nombre'),
				'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
				'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
				'CORREO' => $this->request->getPost('correo'),
			];
			$dataApi = array();
			$dataApi['name']=$this->request->getPost('nombre') .' ' . $this->request->getPost('apellido_paterno');
			$dataApi['details']= $dataApi2;
			$dataApi['gender']= $this->request->getPost('sexo') == 'F' ? "FEMALE": 'MALE';
			$dataApi['languages']= [2];
			$urlApi = "http://34.229.77.149/guests";
			// $urlApi = "http://192.168.0.67:3000/guests";
			$response = $this->_curlPost($urlApi, $dataApi);
			$data['UUID'] = $response->uuid;
			if ($response->uuid) {
			$this->_denunciantesModel->insert($data);
			$this->_sendEmailPassword($data['CORREO'], $password);
			return redirect()->to(base_url('/constancia_extravio'))->with('message_success', 'Inicia sesión con la contraseña que llegará a tu correo e ingresa.');
			}
		} else {
			return redirect()->back()->with('message_error', 'Hubo un error en los datos o puede que ya exista un registro con el mismo correo');
		}
	}

	public function profile()
	{
		$data = (object) array();
		$data->user = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->first();
		$this->_loadView('Perfil', $data, 'perfil');
	}

	public function update_profile()
	{
		$session = session();
		$data = [
			'NOMBRE' => $this->request->getPost('nombre'),
			'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
			'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
			'TELEFONO' => $this->request->getPost('telefono'),
			'TELEFONO2' => $this->request->getPost('telefono2'),
			'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento'),
			'SEXO' => $this->request->getPost('sexo'),
		];
		$update = $this->_denunciantesModel->set($data)->where('DENUNCIANTEID', session('DENUNCIANTEID'))->update();
		if ($update) {
			$session->set('NOMBRE', $data['NOMBRE']);
			$session->set('APELLIDO_PATERNO', $data['APELLIDO_PATERNO']);
			$session->set('APELLIDO_MATERNO', $data['APELLIDO_MATERNO']);
			$session->set('TELEFONO', $data['TELEFONO']);
			$session->set('TELEFONO2', $data['TELEFONO2']);
			$session->set('FECHANACIMIENTO', $data['FECHANACIMIENTO']);
			$session->set('SEXO', $data['SEXO']);
			return redirect()->back()->with('message_success', 'Actualizado correctamente.');
		}
		return redirect()->back()->with('message_error', 'No se pudo actualizar el registro.');
	}

	public function update_password()
	{
		$password = trim($this->request->getPost('password'));
		$data = [
			'PASSWORD' => hashPassword($password),
		];
		$this->_denunciantesModel->set($data)->where('DENUNCIANTEID', session('DENUNCIANTEID'))->update();

		return redirect()->back()->with('message_success', 'Contraseña actualizada correctamente');
	}

	private function _generatePassword($length)
	{
		$password = "";
		$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
		$max = strlen($pattern) - 1;
		for ($i = 0; $i < $length; $i++) {
			$password .= substr($pattern, mt_rand(0, $max), 1);
		}
		return $password;
	}

	public function existEmail()
	{
		$email = $this->request->getPost('email');
		$data = $this->_denunciantesModel->where('CORREO', $email)->first();
		if ($data == NULL) {
			return json_encode((object)['exist' => 0]);
		} else if (count($data) > 0) {
			return json_encode((object)['exist' => 1]);
		} else {
			return json_encode((object)['exist' => 0]);
		}
	}

	private function _sendEmailPassword($to, $password)
	{
		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setSubject('Te estamos atendiendo');
		$body = view('email_template/password_email_constancia.php', ['email' => $to, 'password' => $password]);
		$email->setMessage($body);

		if ($email->send()) {
			return true;
		} else {
			return false;
		}
	}

	public function sendEmailChangePassword()
	{
		$password = $this->_generatePassword(6);
		$to = $this->request->getPost('correo_reset_password');
		$user = $this->_denunciantesModel->asObject()->where('CORREO', $to)->first();
		$this->_denunciantesModel->set('PASSWORD', hashPassword($password))->where('DENUNCIANTEID', $user->DENUNCIANTEID)->update();

		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setSubject('Cambio de contraseña');
		$body = view('email_template/reset_password_template.php', ['password' => $password]);
		$email->setMessage($body);

		if ($email->send()) {
			return redirect()->to(base_url('/constancia_extravio'))->with('message_success', 'Verifica tu nueva contraseña en tu correo.');
		}
	}

	private function _isAuth()
	{
		if (session('logged_in') && session('type') == 'user') {
			return true;
		};
	}
	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];
		echo view("constancia_extravio/register/$view", $data);
	}
	function descargar_pdf()
	{
		$data = (object)array();
		$options = new Options();
		$options->set('isRemoteEnabled', true);
		$dompdf = new Dompdf($options);
		$data = $this->db->table("PLANTILLAS")->get()->getResult();
		$numfolio = $_POST['input_folio_atencion_pdf'];
		$constancias = $this->_constanciaExtravioModel->asObject()->where('CONSTANCIAEXTRAVIOID', base64_decode($numfolio))->first();

		$agente = $this->_usuariosModel->asObject()->where('ID', $constancias->AGENTEID)->first();
		$denunciante = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID', $constancias->DENUNCIANTEID)->first();
		$lugar = $this->_hechoLugarModel->asObject()->where('HECHOLUGARID', $constancias->HECHOLUGARID)->first();
		$municipio = $this->_municipiosModel->asObject()->where('MUNICIPIOID', $constancias->MUNICIPIOID)->where('ESTADOID', $constancias->ESTADOID)->first();
		$estado = $this->_estadosModel->asObject()->where('ESTADOID', $constancias->ESTADOID)->first();
		$timestamp = strtotime($constancias->HECHOFECHA);
		$dia = date('d', $timestamp);
		$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		$mes = $meses[date('n') - 1];
		// $dir = base_url() . '/uploads/FIEL/qrcode_' . $numfolio . '.jpg';
		// $dirFirma = base_url() . '/uploads/FIEL/qrcode_firma_' . $numfolio . '.jpg';
		$dir = base_url() . '/uploads/qr/' . base64_decode($numfolio) . '/qrcode_' . base64_decode($numfolio) . '.jpg';
		$dirFirma = base_url() . '/uploads/qr/' . base64_decode($numfolio) . '/qrcode_firma_' . base64_decode($numfolio) . '.jpg';

		$url = base_url('/validar_constancia?folio=' . $numfolio);
		//replace placeholder
		$data[5]->PLACEHOLDER = str_replace('https://cdtec.fgebc.gob.mx/', ' ', $data[5]->PLACEHOLDER);

		$data[5]->PLACEHOLDER = str_replace('[FOLIO_NUMERO]', $constancias->CONSTANCIAEXTRAVIOID, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[NOMBRE_AGENTE]', $agente->NOMBRE . " " . $agente->APELLIDO_PATERNO . " " . $agente->APELLIDO_MATERNO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[NOMBRE_CERTIFICADO]', $constancias->EXTRAVIO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[NOMBRE_PERSONA]', $denunciante->NOMBRE . " " . $denunciante->APELLIDO_PATERNO . " " . $denunciante->APELLIDO_MATERNO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[LUGAR_EXTRAVIO]', $lugar->HECHODESCR, $data[5]->PLACEHOLDER);
		//$data[5]->PLACEHOLDER = str_replace('[DESCRIPCION_EXTRAVIO]', $constancias->DESCRIPCION_EXTRAVIO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[NOMBRE_CIUDAD]', $municipio->MUNICIPIODESCR . ", " . $estado->ESTADODESCR, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[FECHA_EXTRAVIO]', $constancias->HECHOFECHA, $data[5]->PLACEHOLDER);

		$data[5]->PLACEHOLDER = str_replace('[DIA]', $dia, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[MES]', strtoupper($mes), $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[ANIO]', $constancias->ANO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[HORA]', $constancias->HECHOHORA, $data[5]->PLACEHOLDER);

		$data[5]->PLACEHOLDER = str_replace('[NUMEROIDENTIFICADOR]', $constancias->NUMEROIDENTIFICADOR, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[RFCFIRMA]', $constancias->RFCFIRMA, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[NCERTIFICADOFIRMA]', $constancias->NCERTIFICADOFIRMA, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[FECHAFIRMA]', $constancias->FECHAFIRMA, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[HORAFIRMA]', $constancias->HORAFIRMA, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[LUGARFIRMA]', $constancias->LUGARFIRMA, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[FIRMAELECTRONICA]', $constancias->FIRMAELECTRONICA, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[URL]', $url, $data[5]->PLACEHOLDER);

		$data[5]->PLACEHOLDER = str_replace('[CODIGO_QR]', '<img src="' . $dir . '" width="50px" height="50px">', $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[CODIGO_QRS]', '<img src="' . $dirFirma . '" width="120px" height="120px">', $data[5]->PLACEHOLDER);


		if ($constancias->EXTRAVIO == 'BOLETOS DE SORTEO') {
			$data[5]->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', $constancias->NBOLETO, $data[5]->PLACEHOLDER);
		}
		if ($constancias->EXTRAVIO == 'PLACAS') {
			$data[5]->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', $constancias->NPLACA, $data[5]->PLACEHOLDER);
		}
		if ($constancias->EXTRAVIO == 'DOCUMENTOS') {
			$data[5]->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', $constancias->NDOCUMENTO, $data[5]->PLACEHOLDER);
		} else {
			$data[5]->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', '', $data[5]->PLACEHOLDER);
		}
		$dompdf->loadHtml(view('pdf/constanciaE', ["certificadoMedico" => $data]));
		// setting paper to portrait, also we have landscape
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

		// Download pdf
		$dompdf->stream();
	}
	private function _get_client_ip()
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');

		else if (getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');

		else if (getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');

		else if (getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');

		else if (getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');

		else if (getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		if (strpos($ipaddress, ",") !== false) :
			$ipaddress = strtok($ipaddress, ",");
		endif;
		return $ipaddress;
	}

	private function _get_public_ip()
	{
		try {
			$externalContent = file_get_contents('http://checkip.dyndns.com/');
			preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
			$externalIp = $m[1];
		} catch (\Exception $e) {
			$externalIp = '127.0.0.1';
		}
		return $externalIp;
	}
	public function existEmailSolicitantes()
	{
		$email = $this->request->getPost('email');

		$data = $this->_denunciantesModel->where('CORREO', $email)->first();
		if ($data == NULL) {
			return json_encode((object)['exist' => 0]);
		} else if (count($data) > 0) {
			return json_encode((object)['exist' => 1]);
		} else {
			return json_encode((object)['exist' => 0]);
		}
	}
	private function _curlPost($endpoint, $data)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		$headers = array(
			'Content-Type: application/json',
			'Access-Control-Allow-Origin: *',
			'Access-Control-Allow-Credentials: true',
			'Access-Control-Allow-Headers: Content-Type',
			'X_API_KEY' . X_API_KEY
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

		return json_decode($result);
	}
}
