<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SolicitantesExtravioAuthFilter implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		if (!session('logged_in')) {
			return redirect()->to(base_url('/constancia_extravio'));
		} else {
			if (session('type') == 'admin' || session('type') == 'user') {
				session()->destroy;
				return redirect()->to(base_url('/constancia_extravio'));
			};
		}
	}

	//--------------------------------------------------------------------

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// Do something here
	}
}
