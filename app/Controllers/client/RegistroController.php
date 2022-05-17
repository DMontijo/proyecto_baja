<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;


class RegistroController extends BaseController
{
	public function index()
	{
		$data = array();
		$this->_loadView('Denuncia', $data, 'index');
	}

	private function _loadView($title, $data, $view)
    {
        $data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];

		echo view("client/registro/$view", $data);
    }
}

/* End of file RegistroController.php */
/* Location: ./app/Controllers/client/RegistroController.php */
