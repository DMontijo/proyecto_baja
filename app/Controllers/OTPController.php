<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OTPModel;
use Error;
use GuzzleHttp\Client;
use MailerSend\MailerSend;
use MailerSend\Helpers\Builder\Recipient;
use MailerSend\Helpers\Builder\EmailParams;
use MailerSend\Exceptions\MailerSendValidationException;
use MailerSend\Exceptions\MailerSendRateLimitException;


class OTPController extends BaseController
{
	private $_OTPModel;
	private $_OTPModelRead;
	private $_denunciantesModelRead;
	private $db_read;

	public function __construct()
	{
		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');

		$this->_OTPModel = new OTPModel();
		$this->_OTPModelRead = model('OTPModel', true, $this->db_read);
		$this->_denunciantesModelRead = model('DenunciantesModel', true, $this->db_read);
	}

	/**
	 * Función para generar el OTP
	 * ! Deprecated method, do not use.
	 */
	private function _generarOTP()
	{
		/**6 digitos */
		$rndno = rand(100000, 999999);
		$otp = urlencode($rndno);
		return $otp;
	}
	/**
	 * Función para generar el OTP alfanumerico
	 * ! Deprecated method, do not use.
	 */
	private function _alfanumericMinOTP()
	{
		/**Alfanumerico de 10 digitos , modificar el 10 por la cantidad deseada*/
		/**letras en minusculas */
		$caracteres = '0123456789abcdefghijklmnopqrstuvwxyz';
		$aleatorio = substr(str_shuffle($caracteres), 0, 10);
		return $aleatorio;
	}
	/**
	 * Función para generar el OTP alfanumerico mayusculas
	 * ! Deprecated method, do not use.
	 */
	private function _alfanumericMayOTP()
	{
		/**Alfanumerico de 10 digitos , modificar el 10 por la cantidad deseada*/
		/**letras en mayusculas */
		$caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$aleatorio = substr(str_shuffle($caracteres), 0, 10);
		return $aleatorio;
	}
	/**
	 * Función para generar el OTP alfanumerico (mayusculas y minusculas)
	 * ! Deprecated method, do not use.
	 */
	private function _alfanumericMinMayOTP()
	{
		/**Alfanumerico de 10 digitos , modificar el 10 por la cantidad deseada*/
		/**letras en minusculas y mayusculas */
		$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$aleatorio = substr(str_shuffle($caracteres), 0, 10);
		return $aleatorio;
	}
	/**
	 * Función para enviar por correo el codigo OTP generadp
	 */
	public function sendEmailOTP()
	{
		$to = trim($this->request->getPost('email'));
		$tel = $this->request->getPost('telefono') ? trim($this->request->getPost('telefono')) : null;

		//Generacion de OTP
		$otp = $this->_generarOTP();

		date_default_timezone_set('America/Tijuana');
		$dateTimeVariable = date("Y-m-d H:i:s");
		$nuevafecha = strtotime('+5 minute', strtotime($dateTimeVariable));
		$convert = date("Y-m-d H:i:s", $nuevafecha);

		if ($to) {
			$user = $this->_denunciantesModelRead->asObject()->where('CORREO', $to)->first();

			// $email = \Config\Services::email();
			// $email->setTo($to);
			// $email->setSubject('Nuevo código');
			// $body = view('email_template/token_email_template', ['otp' => $otp]);
			// $email->setMessage($body);
			// $email->setAltMessage('Se ha generado un nuevo código.SU CÓDIGO ES: ' . $otp);

			$mailersend = new MailerSend(['api_key' => EMAIL_TOKEN]);

			$recipients = [
				new Recipient($to, 'Your Client'),
			];

			$body = view('email_template/token_email_template', ['otp' => $otp]);

			$emailParams = (new EmailParams()) //Check envio
				->setFrom('notificacionfgebc@fgebc.gob.mx')
				->setFromName('FGEBC')
				->setRecipients($recipients)
				->setSubject('Nuevo código')
				->setHtml($body)
				->setText('Se ha generado un nuevo código.SU CÓDIGO ES: ' . $otp)
				->setReplyTo('notificacionfgebc@fgebc.gob.mx')
				->setReplyToName('FGEBC');


			$telefono = $user != null ? $user->TELEFONO : $tel;

			$data = [
				'CODIGO_OTP' => $otp,
				'CORREO' => $to,
				'VENCIMIENTO' => $convert,
			];

			$otpRegister = $this->_OTPModelRead->asObject()->where('CORREO', $to)->first();

			if ($otpRegister) {
				$newOTP = $this->_OTPModel->set($data)->where('CORREO', $to)->update();
			} else {
				$newOTP = $this->_OTPModel->insert($data);
			}

			if ($tel) {
				$sendSMS = $this->sendSMS("Nuevo codigo", $tel, 'Notificaciones FGEBC/Estimado usuario, tu codigo es: ' . $otp);
			}
			try {
				$validationEmail = validateEmail($to);
				if(!$validationEmail){
					$result = false;
				} else {
					try {
						$result = $mailersend->email->send($emailParams);
					} catch (MailerSendValidationException $e) {
						$result = false;
					} catch (MailerSendRateLimitException $e) {
						$result = false;
					}
				}
			} catch (\Throwable $error) {
				$result = false;
			}
			

			if ($result) {
				return json_encode((object)['status' => 200]);
			} else {
				// $data = $sendSMS;
				if ($sendSMS == "") {
					return json_encode((object)['status' => 200]);
				} else {
					return json_encode((object)['status' => 500, 'data' => $sendSMS]);
				}
			}
		} else {
			$data = ['message' => 'Error en envío de mensaje'];
			return json_encode((object)['status' => 500, 'data' => $data]);
		}
	}

	/**
	 * Función para validar el OTP enviado y el ingresado
	 * Recibe por metodo POST el email y el codigo
	 *
	 */
	public function validateOTP()
	{
		date_default_timezone_set('America/Tijuana');
		$email = trim($this->request->getPost('email'));
		$otp = trim($this->request->getPost('codigo'));
		$now = date("Y-m-d H:i:s");

		if ($email && $otp) {
			$data = $this->_OTPModelRead->asObject()->where('CORREO', $email)->where('CODIGO_OTP', $otp)->orderBy('IDOTP', 'desc')->first();

			if (!$data) {
				return json_encode((object)['status' => 500, 'message' => 'El código ingresado es incorrecto.']);
			}

			$expire = $data->VENCIMIENTO;
			$today_t = strtotime($now);
			$expire_t = strtotime($expire);

			if ($expire_t < $today_t) {
				return json_encode((object)['status' => 200, 'valid' => false]);
			} else {
				return json_encode((object)['status' => 200, 'valid' => true]);
			}
		} else {
			return json_encode((object)['status' => 500, 'message' => 'Verifica que estás enviando todos los campos.']);
		}
	}

	/**
	 * Función para verificar que existe el OTP
	 * ! Deperecated method, do not use
	 *
	 */
	public function getLastOTP()
	{
		$email = trim($this->request->getPost('email'));
		if ($email) {
			$data = $this->_OTPModelRead->asObject()->where('CORREO', $email)->orderBy('IDOTP', 'desc')->first();
			return json_encode((object)['data' => $data]);
		} else {
			return json_encode((object)['status' => 500, 'data' => ['message' => 'No existe el email.']]);
		}
	}
	/**
	 * Función para enviar mensajes SMS
	 *
	 * @param  mixed $tipo
	 * @param  mixed $celular
	 * @param  mixed $mensaje
	 */
	public function sendSMS($tipo, $celular, $mensaje)
	{

		$endpoint = "http://enviosms.ddns.net/API/";
		$data = array();
		$data['UsuarioID'] = 1;
		$data['Nombre'] = $tipo;
		$lstMensajes = array();
		$obj = array("Celular" =>  $celular, "Mensaje" => $mensaje);
		$lstMensajes[] = $obj;
		$data['lstMensajes'] = $lstMensajes;

		$httpClient = new Client([
			'base_uri' => $endpoint
		]);

		$response = $httpClient->post('campañas/enviarSMS', [
			'json' => $data
		]);

		$respuestaServ = $response->getBody()->getContents();

		return json_decode($respuestaServ);
	}
}
