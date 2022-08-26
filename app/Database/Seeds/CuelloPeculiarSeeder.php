<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CuelloPeculiarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CUELLOPECULIARDESCR' => 'BOCIO'),
            array('CUELLOPECULIARDESCR' => 'PERA'),
            array('CUELLOPECULIARDESCR' => 'PAPADA'),
            array('CUELLOPECULIARDESCR' => 'HINCHADO'),
            array('CUELLOPECULIARDESCR' => 'ARRUGAS ADELANTE'),
            array('CUELLOPECULIARDESCR' => 'ARRUGAS DETRÁS'),
            array('CUELLOPECULIARDESCR' => 'NINGUNA'),


        ];
        $this->db->table('CUELLOPECULIAR')->insertBatch($data);
    }
}
