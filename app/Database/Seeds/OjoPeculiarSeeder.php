<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OjoPeculiarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('OJOPECULIARDESCR' => 'PINTAS BLANCAS'),
            array('OJOPECULIARDESCR' => 'ALBINO-NUBES'),
            array('OJOPECULIARDESCR' => 'DIVERGENTES'),
            array('OJOPECULIARDESCR' => 'CONVERGENTES'),
            array('OJOPECULIARDESCR' => 'PATA-GALLO'),
            array('OJOPECULIARDESCR' => 'PARPADEA CONSTANTE'),
            array('OJOPECULIARDESCR' => 'PARPADOS COLGANDO'),
            array('OJOPECULIARDESCR' => 'USA LENTES'),
            array('OJOPECULIARDESCR' => 'NINGUNA'),


        ];
        $this->db->table('OJOPECULIAR')->insertBatch($data);
    }
}
