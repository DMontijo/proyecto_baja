<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CuelloTamanoSeeder extends Seeder
{
    public function run()
    {
        $data = [
			array('CUELLOTAMANODESCR'=>'ALTO'),
            array('CUELLOTAMANODESCR'=>'CORTO'),
            array('CUELLOTAMANODESCR'=>'MEDIANO'),
            array('CUELLOTAMANODESCR'=>'NINGUNA'),

		
		];
		$this->db->table('CUELLOTAMANO')->insertBatch($data);

    }
}
