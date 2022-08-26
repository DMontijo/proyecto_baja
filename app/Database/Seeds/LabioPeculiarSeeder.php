<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LabioPeculiarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('LABIOPECULIARDESCR'=>'LABIO INFERIOR'),
            array('LABIOPECULIARDESCR'=>'LABIO SUPERIOR'),
            array('LABIOPECULIARDESCR'=>'NINGUNO'),
            
		
		];
		$this->db->table('LABIOPECULIAR')->insertBatch($data);

    }
}
