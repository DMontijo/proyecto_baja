<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class FirmaController extends BaseController
{
	function __construct()
	{
	}

	public function index()
	{
		$user_id = session('ID');
		$password = '12345678a';
		$document_name = "CONSTANCIA DE EXTRAVÍO";
		$informacion = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum iusto quisquam dolor, aspernatur mollitia itaque iste quaerat inventore facere laudantium doloribus fuga quia eaque quae, ipsa saepe, earum ipsum iure";
		$folio = uniqid();
		if ($this->_crearArchivosPEMText($user_id, $password) && $this->_validarFiel($user_id)) {
			$signature = $this->_generateSignature($user_id, $document_name, $informacion, $folio);
			if ($signature->status == 1) {
				$info = $this->_extractData($user_id);
				$xml = $this->_createXMLSignature($signature->signed_chain, $signature->signature, $folio);
				var_dump($info);
				echo '<br><br>';
				var_dump($signature);
				echo '<br><br>';
				echo htmlspecialchars($xml);
			} else {
				echo $signature->message;
			}
		} else {
			return 'Firma no válida';
		}
	}

	private function _crearArchivosPEMText($agenteId, $pass)
	{
		$user_id = $agenteId;
		$password = $pass;
		if ($user_id) {
			$directory = FCPATH . 'uploads/FIEL/' . $user_id;
			$file_key = $user_id . '_key.key';
			$file_cer = $user_id . '_cer.cer';

			$file_key_pem = $user_id . '_key.key.pem';
			$file_cer_pem = $user_id . '_cer.cer.pem';

			$file_txt  = $user_id . "_data.txt";

			if (file_exists($directory)) {
				if (file_exists($directory . '/' . $file_key) && file_exists($directory . '/' . $file_cer)) {

					//CREAR ARCHIVO .KEY.PEM  ******************************************************
					$comando_key_pem = "pkcs8 -inform DER -in " . $directory . '/' . $file_key . " -passin pass:$password -out " . $directory . '/' . $file_key_pem;
					exec('openssl ' . $comando_key_pem, $arr, $status);

					if ($status === 0) {
						chmod($directory . '/' . $file_key_pem, 0777);
					} else {
						throw new \Exception('password error');
					}

					//CREAR ARCHIVO .CER.PEM  ******************************************************
					$comando_cer_pem = "x509 -inform DER -outform PEM -in " . $directory . '/' . $file_cer . " -passin pass:$password -out " . $directory . '/' . $file_cer_pem;
					exec('openssl ' . $comando_cer_pem, $arr, $status);

					if ($status === 0) {
						chmod($directory . '/' . $file_cer_pem, 0777);
					} else {
						throw new \Exception('password error');
					}

					//CREAR ARCHIVO .TXT CON INFO DEL .PEM  ******************************************************
					$comandoOpenSSL = "x509 -in " . $directory . '/' . $file_cer_pem . " > " . $directory . '/' . $file_txt . " -text";
					exec('openssl ' . $comandoOpenSSL, $arr, $status);

					if ($status == 0) {
						chmod($directory . '/' . $file_txt, 0777);
					} else {
						throw new \Exception('password error');
					}

					if (file_exists($directory . '/' . $file_key_pem) && file_exists($directory . '/' . $file_cer_pem) && file_exists($directory . '/' . $file_txt)) {
						return true;
					} else {
						unlink($directory . '/' . $file_key_pem);
						unlink($directory . '/' . $file_cer_pem);
						unlink($directory . '/' . $file_txt);
						return false;
					}
				}
			}
		} else {
			throw new \Exception('id error');
		}
	}

	private function _validarFiel($agentId)
	{
		$user_id = $agentId;
		$directory = FCPATH . 'uploads/FIEL/' . $user_id;
		$file_txt  = $user_id . "_data.txt";

		$sslcert = file_get_contents($directory . '/' . $file_txt);
		$sslcert = array(openssl_x509_parse($sslcert, TRUE));

		foreach ($sslcert as $name => $arrays) {
			foreach ($arrays as $title => $value) {
				if (is_array($value)) {
					foreach ($value as $subtitle => $subvalue) {
						if ($subtitle == "keyUsage") {
							$ArrayUsos = explode(",", $subvalue);
						}
					}
				}
			}
		}

		for ($i = 0; $i < count($ArrayUsos); $i++) {
			if (trim($ArrayUsos[$i]) == "Digital Signature") {
				$ResBus1 = 1;
			}
			if (trim($ArrayUsos[$i]) == "Data Encipherment") {
				$ResBus2 = 1;
			}
			if (trim($ArrayUsos[$i]) == "Key Agreement") {
				$ResBus3 = 1;
			}
		}

		$FechaActual = date("Y/m/d");

		$datosFIEL = file_get_contents($directory . '/' . $file_txt);

		$CadABusc1 = "Not Before:";
		$pos1 = strpos($datosFIEL, $CadABusc1);

		$CadABusc2 = "Not After :";
		$pos2 = strpos($datosFIEL, $CadABusc2);

		$Fecha1 = substr($datosFIEL, $pos1 + 12, 24);
		$Fecha2 = substr($datosFIEL, $pos2 + 12, 24);

		$PrimerFecha  = date("Y/m/d", strtotime($Fecha1));
		$SegundaFecha = date("Y/m/d", strtotime($Fecha2));

		//VERIFICAR SI ES UNA FIEL  ******************************************************
		if ($ResBus1 == 1 && $ResBus2 == 1 && $ResBus3 == 1) {
			# VERIFICAR VIGENCIA DE LA FIEL  ******************************************************
			if ($FechaActual >= $PrimerFecha && $FechaActual <= $SegundaFecha) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	private function _extractData($agentId)
	{
		$user_id = $agentId;
		$directory = FCPATH . 'uploads/FIEL/' . $user_id;
		$file_cer_pem = $user_id . '_cer.cer.pem';

		$Comando_NoCert = "x509 -in " . $directory . '/' . $file_cer_pem . " -noout -serial";
		$NoCert = exec('openssl ' . $Comando_NoCert, $arr, $status);
		$NoCert = $this->_ConvANum($NoCert);
		$NoCert = trim($this->_ExtraeNoCer($NoCert));

		// Obtener la Razon social y RFC.

		$Comando_DatosContrib = "x509 -in " . $directory . '/' . $file_cer_pem . " -noout -subject -nameopt oneline,-esc_msb";
		$NomProp = exec('openssl ' . $Comando_DatosContrib, $arr, $status);

		if ($status === 0) {
			$ArraySubject = explode(",", $NomProp);
			$ArrayNom = explode("=", $ArraySubject[1]);
			$ArrayRFC = explode("=", $ArraySubject[5]);
			$razonSocial = trim($ArrayNom[1]);
			$rfc = trim($ArrayRFC[1]);
			return (object)['razon_social' => $razonSocial, 'rfc' => $rfc, 'num_certificado' => $NoCert];
		} else {
			return false;
		}
	}

	private function _generateSignature($agentId, $documentName, $text, $folio)
	{
		$fecha = date("d/m/Y");
		$hora  = date("H:i:s");
		$directory = FCPATH . 'uploads/FIEL/' . $agentId;
		$file_key_pem = $agentId . '_key.key.pem';
		$file_cer_pem = $agentId . '_cer.cer.pem';

		//Firmar cadena
		$cadena_a_firmar = $fecha . "|" . $hora . "|" . $folio . "|" . $documentName . "|" . $text;

		// traer la clave privada desde el archivo y prepararla. =======================
		$fp = fopen($directory . '/' . $file_key_pem, "r");
		$priv_key = fread($fp, 8192);
		fclose($fp);
		$pkeyid = openssl_get_privatekey($priv_key);

		// Generar la firma ============================================================
		try {
			openssl_sign($cadena_a_firmar, $signature, $pkeyid, OPENSSL_ALGO_SHA512);
		} catch (\Exception $e) {
			return (object)['status' => 0, 'message' => 'Password inválido'];
		}

		// Liberar la clave de la memoria ==============================================
		openssl_free_key($pkeyid);

		// Verificar que firma sea valida ==============================================
		// traer la clave pública desde el certifiado y prepararla
		$fp = fopen($directory . '/' . $file_cer_pem, "r");
		$cert = fread($fp, 8192);
		fclose($fp);
		$pubkeyid = openssl_get_publickey($cert);

		$ok = openssl_verify($cadena_a_firmar, $signature, $pubkeyid, OPENSSL_ALGO_SHA512);

		// Liberar la clave de la memoria ==============================================
		openssl_free_key($pubkeyid);
		if ($ok == 1) {
			return (object)['status' => 1, 'signature' => base64_encode($signature), 'signed_chain' => $cadena_a_firmar, 'fecha' => $fecha, 'hora' => $hora];
		} else {
			return (object)['status' => 0];
		}
	}

	private function _createXMLSignature($signed_chain, $e_signature, $folio)
	{

		$xml  = new \DOMdocument('1.0', 'UTF-8');

		$root = $xml->createElement("documento");
		$root = $xml->appendChild($root);

		$datsDoc = $xml->createElement("DatosDelDocumento");
		$datsDoc = $root->appendChild($datsDoc);

		$firmaDigital = $xml->createElement("FirmaDigital");
		$firmaDigital = $root->appendChild($firmaDigital);
		$directory = FCPATH . 'uploads/FIEL/21';
		$file_xml = $folio . '_' . date('Y') . '.xml';

		$this->_loadAtt(
			$firmaDigital,
			array(
				"CadenaFirmada" => "$signed_chain",
				"FirmaBase64" => "$e_signature"
			)
		);

		$ArchXML = $xml->saveXML();
		// $xml->formatOutput = true;
		// $xml->save($directory . '/' . $file_xml); // Guarda el archivo .XML
		unset($xml);
		return $ArchXML;
	}

	private function _ConvANum($str)
	{
		$legalChars = "%[^0-9\-\. ]%";
		$str        = preg_replace($legalChars, "", $str);
		return $str;
	}

	private function _ExtraeNoCer($Cad)
	{
		$Cad1 = $Cad;
		$Cad2 = "";
		while (strlen($Cad1) > 0) {
			$Cad2 .= substr($Cad1, 1, 1);
			$Cad1 = substr($Cad1, 2, strlen($Cad1) - 2);
		}
		return $Cad2;
	}

	private function _loadAtt(&$nodo, $attr)
	{
		global $xml;
		foreach ($attr as $key => $val) {
			$val = trim($val);
			if (strlen($val) > 0) {
				$nodo->setAttribute($key, $val);
			}
		}
	}
}
/* End of file FirmaController.php */
/* Location: ./app/Controllers/admin/FirmaController.php */
