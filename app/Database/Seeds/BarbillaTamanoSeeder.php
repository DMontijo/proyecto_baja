<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarbillaTamanoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('BARBILLATAMANODESCR'=>'NORMAL'),
            array('BARBILLATAMANODESCR'=>'CORTA'),
            array('BARBILLATAMANODESCR'=>'LARGA'),
            array('BARBILLATAMANODESCR'=>'NINGUNA'),
		
		];
		$this->db->table('BARBILLATAMANO')->insertBatch($data);

    }
}
