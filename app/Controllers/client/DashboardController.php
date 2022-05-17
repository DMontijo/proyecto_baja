<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;


class DashboardController extends BaseController
{
    public function index()
    {
        $data = array();
        $this->_loadView('Dashboard', 'dashboard', '', $data, 'index');
    }

    public function video_denuncia()
    {
        $data = array();
        $this->_loadView('Video denuncia', 'video-denuncia', '', $data, 'video_denuncia');
    }

    public function denuncias()
    {
        $data = array();
        $this->_loadView('Mis denuncias', 'denuncias', '', $data, 'lista_denuncias');
    }

	private function _loadView($title, $menu, $submenu, $data, $view)
    {
        $data2 = [
			'header_data' => (object)['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data
		];

		echo view("client/dashboard/$view", $data2);
    }
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/client/DashboardController.php */
