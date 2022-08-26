<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CabezaTamanoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CABEZATAMANODESCR'=>'PEQUEÑA'),
            array('CABEZATAMANODESCR'=>'NORMAL'),
            array('CABEZATAMANODESCR'=>'GRANDE'),
            array('CABEZATAMANODESCR'=>'NINGUNA'),
		
		];
		$this->db->table('CABEZATAMANO')->insertBatch($data);
    }
}
