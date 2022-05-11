<?php

namespace App\Controllers;

class HomeController extends BaseController
{
	public function index()
	{
		$data = array();
		$this->_loadView('Inicio', $data, 'index');
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
