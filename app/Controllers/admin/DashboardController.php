<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;


class DashboardController extends BaseController
{
    public function index()
    {
        $data = array();
        $this->_loadViewDashboard('Principal', 'dashboard', '', $data, 'index');
    }

    public function atencion()
    {
        $data = array();
        $this->_loadViewDashboard('Video denuncia', 'videodenuncia', '', $data, 'atencion');
    }

    private function _loadViewDashboard($title = '', $menu = '', $submenu = '', $data, $view)
    {
        $header_data = [
            'title' => $title,
            'menu' => $menu,
            'submenu' => $submenu
        ];

        echo view("admin/templates/dashboard_header", $header_data);
        echo view("admin/templates/dashboard_sidebar", $header_data);
        echo view("admin/dashboard/$view", $data);
        echo view("admin/templates/dashboard_footer");
    }
}
