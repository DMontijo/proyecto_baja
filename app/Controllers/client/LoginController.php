<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;


class LoginController extends BaseController
{
    public function index()
    {
        $data = array();
        $this->_loadView('Login', $data, 'index');
    }

    public function change_password()
    {
        $data = array();
        $this->_loadView('Recuperar', $data, 'change_password');
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
