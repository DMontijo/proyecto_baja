<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OTPModel;

class OTPController extends BaseController
{
	public function __construct()
	{
		$this->_OTPModel = new OTPModel();
	}

	private function _generarOTP()
	{
		/**6 digitos */
		$rndno = rand(100000, 999999);
		$otp = urlencode($rndno);
		return $otp;
	}
	private function _alfanumericMinOTP()
	{
		/**Alfanumerico de 10 digitos , modificar el 10 por la cantidad deseada*/
		/**letras en minusculas */
		$caracteres = '0123456789abcdefghijklmnopqrstuvwxyz';
		$aleatorio = substr(str_shuffle($caracteres), 0, 10);
		return $aleatorio;
	}
	private function _alfanumericMayOTP()
	{
		/**Alfanumerico de 10 digitos , modificar el 10 por la cantidad deseada*/
		/**letras en mayusculas */
		$caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$aleatorio = substr(str_shuffle($caracteres), 0, 10);
		return $aleatorio;
	}
	private function _alfanumericMinMayOTP()
	{
		/**Alfanumerico de 10 digitos , modificar el 10 por la cantidad deseada*/
		/**letras en minusculas y mayusculas */
		$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$aleatorio = substr(str_shuffle($caracteres), 0, 10);
		return $aleatorio;
	}

	public function sendEmailOTP()
	{
		$to = $this->request->getPost('email');
		$otp = $this->_generarOTP();

		date_default_timezone_set('America/Tijuana');
		$dateTimeVariable = date("Y-m-d H:i:s");
		$nuevafecha = strtotime('+5 minute', strtotime($dateTimeVariable));
		$convert = date("Y-m-d H:i:s", $nuevafecha);

		if ($to) {

			$email = \Config\Services::email();
			$email->setTo($to);
			$email->setSubject('Nuevo código');
			$body = view('email_template/token_email_template', ['otp' => $otp]);
			$email->setMessage($body);

			$data = [
				'CODIGO_OTP' => $otp,
				'CORREO' => $to,
				'VENCIMIENTO' => $convert,
			];

			$this->_OTPModel->insert($data);

			if ($email->send()) {
				return json_encode((object)['status' => 200]);
			} else {
				$data = $email->printDebugger(['headers']);
				return json_encode((object)['status' => 500, 'data' => $data]);
			}
		} else {
			$data = ['message' => 'Error en envío de mensaje'];
			return json_encode((object)['status' => 500, 'data' => $data]);
		}
	}

	public function getLastOTP()
	{
		$email = $this->request->getPost('email');
		$data = $this->_OTPModel->asObject()->where('CORREO', $email)->orderBy('IDOTP', 'desc')->first();
		return json_encode((object)['data' => $data]);
	}
}
