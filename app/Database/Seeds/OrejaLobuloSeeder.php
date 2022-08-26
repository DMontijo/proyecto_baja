<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrejaLobuloSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('OREJALOBULODESCR' => 'SEPARADO'),
            array('OREJALOBULODESCR' => 'PEGADO'),
            array('OREJALOBULODESCR' => 'CUADRADO'),
            array('OREJALOBULODESCR' => 'COLGANTE'),
            array('OREJALOBULODESCR' => 'DESCENDENTE'),
            array('OREJALOBULODESCR' => 'NINGUNA'),



        ];
        $this->db->table('OREJALOBULO')->insertBatch($data);
    }
}
