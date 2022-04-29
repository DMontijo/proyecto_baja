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
        $header_data = [
            'title' => $title
        ];

        echo view("client/templates/header", $header_data);
        echo view("client/registro/$view", $data);
        echo view("client/templates/footer");
    }
}