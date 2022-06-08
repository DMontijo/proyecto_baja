<?php

namespace App\Controllers;

use App\Models\OTPModel;
use App\Controllers\BaseController;

class CorreoController extends BaseController
{
	public function index()
	{
		return view('email_view');
	}

	public function sendEmail()
	{
		$to = $this->request->getVar('email');

		$rndno = rand(100000, 999999); //OTP generate
		$message = urlencode($rndno);

		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setFrom('andrea.solorzano@yocontigo-it.com', 'FGEBC - TEST');
		$email->setSubject('Subject');
		$email->setMessage("Token: " . $message);

		date_default_timezone_set('America/Tijuana');
		$dateTimeVariable = date("Y-m-d H:i:s");

		$nuevafecha = strtotime('+1 minute', strtotime($dateTimeVariable));
		$convert = date("Y-m-d H:i:s", $nuevafecha);

		$datos = [
			'CODIGO_OTP' => $message,
			'CORREO' => $to,
			'VENCIMIENTO' => $convert,
		];

		$model = new OTPModel();
		$model->insert($datos);

		if ($email->send()) {
			// echo '<script>alert("Email successfully sent")</script>';
			// echo view('client/registro/otp_validation_modal', $data);
			var_dump(json_encode($datos));
		} else {
			$data = $email->printDebugger(['headers']);
			var_dump(json_encode($data));
		}
	}

	public function resend()
	{
		$to = $this->request->getPost('to');
		$subject = $this->request->getPost('asunto');

		if ($to && $subject) {
			$rndno = rand(100000, 999999); //OTP generate
			$message = urlencode($rndno);

			$data['mensaje'] = $message;
			$data['to'] = $to;

			$email = \Config\Services::email();
			$email->setTo($to);
			$email->setFrom('andrea.solorzano@yocontigo-it.com', 'Prueba');

			$email->setSubject($subject);
			$email->setMessage('OTP code: ' . $message);

			date_default_timezone_set('America/Tijuana');
			$dateTimeVariable = date("Y-m-d H:i:s");

			$nuevafecha = strtotime('+1 minute', strtotime($dateTimeVariable));
			$convert = date("Y-m-d H:i:s", $nuevafecha);

			$data['fecha'] = $convert;
			$datos = [
				'CODIGO_OTP' => $message,
				'CORREO' => $to,
				'VENCIMIENTO' => $convert,
			];
			$model = new OTPModel();
			$model->insert($datos);

			if ($email->send()) {
				return json_encode((object)['data' => $data]);
			} else {
				$data = $email->printDebugger(['headers']);
				return json_encode((object)['data' => $data]);
			}
		} else {
			$data['message'] = 'Fallo to and subject';
			return json_encode((object)['data' => $data]);
		}
	}

	public function getLastOTP()
	{
		$email = $this->request->getPost('email');
		$model = new OTPModel();
		$data = $model->asObject()->where('CORREO', $email)->orderBy('IDOTP', 'desc')->first();
		return json_encode((object)['data' => $data]);
	}


	public function modal_view()
	{
		return view('client/registro/otp_validation_modal');
	}
}
/* End of file DashboardController.php */
/* Location: ./app/Controllers/admin/DashboardController.php */
