<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        echo view('templates/header');
        echo view('home_view');
        echo view('templates/footer');
    }
}
