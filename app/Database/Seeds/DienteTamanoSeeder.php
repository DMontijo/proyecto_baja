<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DienteTamanoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('DIENTETAMANODESCR'=>'PEQUEÑOS'),
            array('DIENTETAMANODESCR'=>'MEDIANOS'),
            array('DIENTETAMANODESCR'=>'GRANDES'),
            array('DIENTETAMANODESCR'=>'NINGUNA'),
            
		];
		$this->db->table('DIENTETAMANO')->insertBatch($data);

    }
}
