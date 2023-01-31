<?php

namespace App\Filters;

use App\Models\SesionesModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminAuthFilter implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		$sessionModel = new SesionesModel();
		$control_session = $sessionModel->asObject()->where('ID_USUARIO', session('ID'))->where('ACTIVO', 1)->first();
		
		if ($control_session) {
			if ($control_session->ID != session('uuid')) {
				session()->destroy;
				session_unset();
				return redirect()->to(base_url('/admin'));
			}
		} else {
			session()->destroy;
			session_unset();
			return redirect()->to(base_url('/admin'));
		}

		if (!session('logged_in')) {
			return redirect()->to(base_url('/admin'));
		} else if (session('type') == 'user' || session('type') == 'user_constancias') {
			session()->destroy;
			session_unset();
			return redirect()->to(base_url('/admin'));
		}
	}

	//--------------------------------------------------------------------

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
	}
}
