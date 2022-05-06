<?php

namespace App\Controllers;

class Dashboard extends BaseController
    {
        public function index()
        {
            $data = array();
            $this->_loadView('Dashboard', $data, 'index');
        }
        public function registrarUsuario()
        {
            $data = array();
            $this->_loadView('Dashboard', $data, 'registrarUsuario');
        }
        public function videollamadasAtendidas()
        {
            $data = array();
            $this->_loadView('Dashboard', $data, 'videollamadasAtendidas');
        }
        private function _loadView($title, $data, $view)
        {
            $header_data = [
                'title' => $title
            ];
    
            echo view("templates/headerAdmin_template", $header_data);
            echo view("templates/sidebarAdmin_template");
            echo view("admin/dashboard/$view", $data);
            echo view("templates/footerAdmin_template");
        }
    }
  /*  public function index()
    {
        echo view("templates/headerAdmin_template");
        echo view("templates/sidebarAdmin_template");
         echo view("admin/dashboard/index");
         echo view("templates/footerAdmin_template");
    }

    private function registrarUsuario()
    {
       
    }*/

