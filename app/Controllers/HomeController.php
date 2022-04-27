<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $header_data = [
            'title' => 'Servicios'
        ];

        echo view('templates/header',$header_data);
        echo view('home_view');
        echo view('templates/footer');
    }
}
