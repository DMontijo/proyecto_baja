<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class DenunciantesAuthFilter implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		if (!session('logged_in')) {
			return redirect()->to(base_url('/denuncia'));
		} else if (session('type') == 'admin') {
			session()->destroy;
			session_unset();
			return redirect()->to(base_url('/denuncia'));
		} else if (session('TIPO') == 2) {
			return redirect()->to(base_url('/denuncia/actualizar_info'));
		}
	}

	//--------------------------------------------------------------------

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// Do something here
	}
}
