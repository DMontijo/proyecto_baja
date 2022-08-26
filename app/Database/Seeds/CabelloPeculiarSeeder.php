<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CabelloPeculiarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CABELLOPECULIARDESCR' => 'LACIO'),
            array('CABELLOPECULIARDESCR' => 'ONDULADO'),
            array('CABELLOPECULIARDESCR' => 'RIZADO'),
            array('CABELLOPECULIARDESCR' => 'REBELDE'),
            array('CABELLOPECULIARDESCR' => 'RALO'),
            array('CABELLOPECULIARDESCR' => 'TUPIDO'),
            array('CABELLOPECULIARDESCR' => 'CHUZO'),
            array('CABELLOPECULIARDESCR' => 'ENTRADA PATI'),
            array('CABELLOPECULIARDESCR' => 'CALVICIE FRONTAL'),
            array('CABELLOPECULIARDESCR' => 'CALVICIE OCCIPITAL'),
            array('CABELLOPECULIARDESCR' => 'CALVICIE TOTAL'),
            array('CABELLOPECULIARDESCR' => 'NINGUNA'),



        ];
        $this->db->table('CABELLOPECULIAR')->insertBatch($data);
    }
}
