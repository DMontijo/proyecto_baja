<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BigoteFormaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('BIGOTEFORMADESCR'=>'RECTO'),
            array('BIGOTEFORMADESCR'=>'CURVO'),
            array('BIGOTEFORMADESCR'=>'NINGUNA'),            
		
		];
		$this->db->table('BIGOTEFORMA')->insertBatch($data);

    }
}
