<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DienteTipoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('DIENTETIPODESCR' => 'NATURALES'),
            array('DIENTETIPODESCR' => 'POSTIZOS TOTAL'),
            array('DIENTETIPODESCR' => 'POSTIZOS SUPERIOR'),
            array('DIENTETIPODESCR' => 'POSTIZOS INFERIOR'),
            array('DIENTETIPODESCR' => 'FALTAN PIEZAS'),
            array('DIENTETIPODESCR' => 'SIN DIENTES'),
            array('DIENTETIPODESCR' => 'NINGUNA'),

        ];
        $this->db->table('DIENTETIPO')->insertBatch($data);
    }
}
