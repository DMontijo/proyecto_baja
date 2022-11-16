<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermisosSeeder extends Seeder
{
    public function run()
    {
        
		$data = [
			array('PERMISOID' => '1', 'PERMISODESCR'=>'VIDEODENUNCIA'),
			array('PERMISOID' => '2', 'PERMISODESCR'=>'BUSQUEDA DE FOLIO'),
			array('PERMISOID' => '3', 'PERMISODESCR'=>'FOLIOS'),
			array('PERMISOID' => '4', 'PERMISODESCR'=>'CONSTANCIAS DE EXTRAVIOS'),
			array('PERMISOID' => '5', 'PERMISODESCR'=>'DOCUMENTOS'),
            array('PERMISOID' => '6', 'PERMISODESCR'=>'USUARIOS'),
			array('PERMISOID' => '7', 'PERMISODESCR'=>'REPORTES'),
			array('PERMISOID' => '8', 'PERMISODESCR'=>'ROLES'),
			array('PERMISOID' => '9', 'PERMISODESCR'=>'VIDEOS'),




		];
		$this->db->table('PERMISOS')->insertBatch($data);
    }
}
