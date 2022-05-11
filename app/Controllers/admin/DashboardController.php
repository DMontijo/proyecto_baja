<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;


class DashboardController extends BaseController
{
	public function index()
	{
		$data = array();
		$this->_loadView('Principal', 'dashboard', '', $data, 'index');
	}

	public function video_denuncia()
	{
		$data = array();
		$this->_loadView('Video denuncia', 'videodenuncia', '', $data, 'video_denuncia');
	}

	private function _loadView($title, $menu = '', $submenu = '', $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data
		];

		echo view("admin/dashboard/$view", $data);
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/admin/DashboardController.php */
