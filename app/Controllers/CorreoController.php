<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class CorreoController extends Controller
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
        //$message = $this->mRequest->getVar('mensaje');
        $rndno = rand(100000, 999999); //OTP generate
        $message = urlencode($rndno);
        $data ['mensaje'] = $message;
        $data['to'] = $to;
        $data['otp'] = $rndno;
        //$txt = "OTP: ".$rndno."";
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('andrea.solorzano@yocontigo-it.com', 'Prueba');

        $email->setSubject($subject);
        $email->setMessage("otp number" . $message);
        if ($email->send()) {
            echo '<script>alert("Email successfully sent")</script>';
            // echo 'Email successfully sent';
            echo view('client/registro/otp_validation_modal', $data);
           // return redirect()->to(base_url('/otp'));
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }
    public function modal_view()
    {
        return view('client/registro/otp_validation_modal');
    }
}
/* End of file DashboardController.php */
/* Location: ./app/Controllers/admin/DashboardController.php */
