<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LabioPosicionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('LABIOPOSICIONDESCR'=>'NORMAL'),
            array('LABIOPOSICIONDESCR'=>'INFERIOR SALIDO'),
            array('LABIOPOSICIONDESCR'=>'SUPERIOR SOBR.'),
            array('LABIOPOSICIONDESCR'=>'AMBOS SOBR.'),
            array('LABIOPOSICIONDESCR'=>'NINGUNA'),
            
		
		];
		$this->db->table('LABIOPOSICION')->insertBatch($data);

    }
}
