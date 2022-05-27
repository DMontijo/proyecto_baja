<?php

namespace App\Controllers;

use App\Models\OTPModel;
use CodeIgniter\Controller;

class CorreoOTPController extends Controller
{
	public function index()
	{
		return view('email_view');
	}

	protected $mRequest;

	public function __construct()
	{
		$this->mRequest = service("request");
	}

	public function sendMail()
	{
		$to = $this->mRequest->getVar('destinatario');

		$subject = $this->mRequest->getVar('asunto');
		$rndno = rand(100000, 999999); //OTP generate
		$message = urlencode($rndno);
		$data['mensaje'] = $message;
		$data['to'] = $to;

		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setFrom('andrea.solorzano@yocontigo-it.com', 'Prueba');

		$email->setSubject($subject);
		$email->setMessage("otp number " . $message);
		date_default_timezone_set('America/Mexico_City');
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
			echo '<script>alert("Email successfully sent")</script>';
			echo view('client/registro/otp_validation_modal', $data);
			//var_dump(json_encode($data));
		} else {
			$data = $email->printDebugger(['headers']);
			print_r($data);
		}
	}

	public function resend()
	{
		$to = $this->mRequest->getPost('to');
		$subject = $this->mRequest->getPost('asunto');

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

			date_default_timezone_set('America/Mexico_City');
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
		$email = $this->mRequest->getPost('email');
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
