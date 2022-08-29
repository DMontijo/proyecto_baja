<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminAuthFilter implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
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
		// Do something here
	}
}
