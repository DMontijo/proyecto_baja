<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        echo view("templates/headerAdmin_template");
        echo view("templates/sidebarAdmin_template");
         echo view("admin/dashboard/index");
         echo view("templates/footerAdmin_template");
    }

    private function _loadView($data, $view)
    {
       
    }
}
