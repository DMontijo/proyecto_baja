<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;


class LoginController extends BaseController
{
    public function index()
    {
        $data = array();
        $this->_loadView('Login', $data, 'index');
    }

	private function _loadView($title, $data, $view)
    {
        $data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];

		echo view("admin/login/$view", $data);
    }
}

/* End of file LoginController.php */
/* Location: ./app/Controllers/admin/LoginController.php */
