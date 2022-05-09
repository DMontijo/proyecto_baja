<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;


class DashboardController extends BaseController
{
    public function index()
    {
        $data = array();
        $this->_loadViewDashboard('Dashboard', 'dashboard', '', $data, 'index');
    }

    public function video_denuncia()
    {
        $data = array();
        $this->_loadViewDashboard('Video denuncia', 'video-denuncia', '', $data, 'video_denuncia');
    }

    public function denuncias()
    {
        $data = array();
        $this->_loadViewDashboard('Mis denuncias', 'denuncias', '', $data, 'lista_denuncias');
    }

    private function _loadViewDashboard($title = '', $menu = '', $submenu = '', $data, $view)
    {
        $header_data = [
            'title' => $title,
            'menu' => $menu,
            'submenu' => $submenu
        ];

        echo view("client/templates/dashboard_header", $header_data);
        echo view("client/dashboard/$view", $data);
        echo view("client/templates/dashboard_footer");
    }
}
