<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HombroPosicionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('HOMBROPOSICIONDESCR'=>'RECTOS'),
            array('HOMBROPOSICIONDESCR'=>'CAIDOS'),
            array('HOMBROPOSICIONDESCR'=>'SEMICAIDOS'),
            array('HOMBROPOSICIONDESCR'=>'RECOGIDOS'),
            array('HOMBROPOSICIONDESCR'=>'NINGUNA'),
            

		
		];
		$this->db->table('HOMBROPOSICION')->insertBatch($data);
    }
}
