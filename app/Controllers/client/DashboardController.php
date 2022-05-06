<?php

namespace App\Controllers\client;
use App\Controllers\BaseController;


class DashboardController extends BaseController
{
    public function index()
    {
        $data = array();
        $this->_loadView('Login', $data, 'index');
    }

    private function _loadView($title, $data, $view)
    {
        $header_data = [
            'title' => $title
        ];

        echo view("client/templates/header_login", $header_data);
        echo view("client/login/$view", $data);
        echo view("client/templates/footer_login");
    }
}