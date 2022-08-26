<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CabezaFormaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CABEZAFORMADESCR' => 'OVIFORME'),
            array('CABEZAFORMADESCR' => 'ABULTADA SUPERIOR'),
            array('CABEZAFORMADESCR' => 'ACHATADA ATRÁS'),
            array('CABEZAFORMADESCR' => 'REDONDA'),
            array('CABEZAFORMADESCR' => 'OVALADA'),
            array('CABEZAFORMADESCR' => 'PLANA POSTERIOR'),
            array('CABEZAFORMADESCR' => 'NINGUNA'),



        ];
        $this->db->table('CABEZAFORMA')->insertBatch($data);
    }
}
