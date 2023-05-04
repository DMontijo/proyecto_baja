<?php

namespace App\Controllers;

class HomeController extends BaseController
{
	public function index()
	{
		$data = array();
		$this->_loadView('Inicio', $data, 'index');
	}

	//Función que muestra la vista de mantenimiento
	public function maintenance()
	{
		$data = array();
		$this->_loadView('Sitio en mantenimiento', $data, 'mantenimiento');
	}

	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];

		echo view($view, $data);
	}
}

/* End of file HomeController.php */
/* Location: ./app/Controllers/HomeController.php */
