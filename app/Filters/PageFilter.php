<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PageFilter implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		$rol1 = array();
		$rol2 = array();
		$rol3 = array();
		$rol4 = array();
		$rol5 = array();
		$rol6 = array();
		$rol7 = array();
		$rol8 = array();

		foreach (session('permisos') as $key => $permiso) {
			if ($permiso['PERMISO'] == 1) {
				array_push($rol1, $permiso);
			} else if ($permiso['PERMISO'] == 2) {
				array_push($rol2, $permiso);
			} else if ($permiso['PERMISO'] == 3) {
				array_push($rol3, $permiso);
			} else if ($permiso['PERMISO'] == 4) {
				array_push($rol4, $permiso);
			} else if ($permiso['PERMISO'] == 5) {
				array_push($rol5, $permiso);
			} else if ($permiso['PERMISO'] == 6) {
				array_push($rol6, $permiso);
			} else if ($permiso['PERMISO'] == 7) {
				array_push($rol7, $permiso);
			} else if ($permiso['PERMISO'] == 8) {
				array_push($rol8, $permiso);
			}
		}
		if (sizeof($rol1) == 0) {
			unset($rol1);
		}
		if (sizeof($rol2) == 0) {
			unset($rol2);
		}
		if (sizeof($rol3) == 0) {
			unset($rol3);
		}
		if (sizeof($rol4) == 0) {
			unset($rol4);
		}
		if (sizeof($rol5) == 0) {
			unset($rol5);
		}
		if (sizeof($rol6) == 0) {
			unset($rol6);
		}
		if (sizeof($rol7) == 0) {
			unset($rol7);
		}
		if (sizeof($rol8) == 0) {
			unset($rol8);
		}
		// var_dump($rol1,$rol2,$rol3,$rol4,$rol5,$rol6,$rol7,$rol8);
		// // var_dump(isset($rol3));
		// // var_dump(isset($rol1),isset($rol2),isset($rol3),isset($rol4),isset($rol5),isset($rol6),isset($rol7),isset($rol8));
		// exit;
		
		if (isset($rol1)) {
			// if ($rol1[0]['PERMISO'] == 1) {
				$this->_loadRoute('/admin/dashboard/video-denuncia');
			// } else {
			// 	return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'Acceso denegado a esta pagina, solicita a soporte');
			// }
		}else{
			return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'No tienes acceso');

		}
		if (isset($rol2)) {
			// if ($rol2[0]['PERMISO'] == 2) {
				$this->_loadRoute('/admin/dashboard/buscar_folio');
			// } else {
			// 	return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'Acceso denegado a esta pagina, solicita a soporte');
			// }
		}else{
			return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'No tienes acceso');

		}
		if (isset($rol3)) {
			// if ($rol3[0]['PERMISO'] == 3) {
				$this->_loadRoute('/admin/dashboard/folios');
			// } else {
			// 	return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'Acceso denegado a esta pagina, solicita a soporte');
			// }
		}else{
			return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'No tienes acceso');

		}
		if (isset($rol4)) {
			// if ($rol4[0]['PERMISO'] == 4) {
				$this->_loadRoute('/admin/dashboard/constancias');
			// } else {
			// 	return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'Acceso denegado a esta pagina, solicita a soporte');
			// }
		}else{
			return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'No tienes acceso');

		}
		if (isset($rol5)) {
			// if ($rol5[0]['PERMISO'] == 5) {
				$this->_loadRoute('/admin/dashboard/documentos');
			// } else {
			// 	return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'Acceso denegado a esta pagina, solicita a soporte');
			// }
		}else{
			return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'No tienes acceso');

		}
		if (isset($rol6)) {
			// if ($rol6[0]['PERMISO'] == 6) {
				$this->_loadRoute('/admin/dashboard/usuarios');
			// } else {
			// 	return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'Acceso denegado a esta pagina, solicita a soporte');
			// }
		}else{
			return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'No tienes acceso');

		}
		if (isset($rol7)) {
			// if ($rol7[0]['PERMISO'] == 7) {
				$this->_loadRoute('/admin/dashboard/reportes');
			// } else {
			// 	return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'Acceso denegado a esta pagina, solicita a soporte');
			// }
		}else{
			return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'No tienes acceso');

		}
		if (isset($rol8)) {
			// if ($rol8[0]['PERMISO'] == 8) {
				$this->_loadRoute('/admin/dashboard/roles');
			// } else {
			// 	return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'Acceso denegado a esta pagina, solicita a soporte');
			// }
		}else{
			return redirect()->to(base_url('/admin/dashboard'))->with('acceso_denegado', 'No tienes acceso');

		}

	}
	private function _loadRoute($ruta)
	{

		// return redirect()->to(base_url($ruta));
		// echo base_url($ruta);
		base_url($ruta);
		//  base_url().'/'.$ruta;
	}
	//--------------------------------------------------------------------

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// Do something here
	}
}
