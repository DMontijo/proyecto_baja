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
        $header_data = [
            'title' => $title
        ];

        echo view("client/templates/header_login", $header_data);
        echo view("admin/login/$view", $data);
        echo view("client/templates/footer_login");
    }
}