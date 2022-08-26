<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CaraFormaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CARAFORMADESCR'=>'ALARGADA'),
            array('CARAFORMADESCR'=>'CUADRADA'),
            array('CARAFORMADESCR'=>'OVALADA'),
            array('CARAFORMADESCR'=>'REDONDA'),
	
		];
		$this->db->table('CARAFORMA')->insertBatch($data);
    }
}
