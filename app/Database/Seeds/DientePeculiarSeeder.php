<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DientePeculiarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('DIENTEPECULIARDESCR' => 'BLANCOS'),
            array('DIENTEPECULIARDESCR' => 'MUY BLANCOS'),
            array('DIENTEPECULIARDESCR' => 'MANCHADOS'),
            array('DIENTEPECULIARDESCR' => 'AMARILLOS'),
            array('DIENTEPECULIARDESCR' => 'TORCIDOS'),
            array('DIENTEPECULIARDESCR' => 'SAL. EXTREMOS'),
            array('DIENTEPECULIARDESCR' => 'MAL ESTADO'),
            array('DIENTEPECULIARDESCR' => 'CALZADOS'),
            array('DIENTEPECULIARDESCR' => 'NINGUNA'),


        ];
        $this->db->table('DIENTEPECULIAR')->insertBatch($data);
    }
}
