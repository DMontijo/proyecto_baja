<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;


class LoginAdminController extends BaseController
{
    public function index()
    {
        $data = array();
        $this->_loadView('Login Admin', $data, 'login');
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