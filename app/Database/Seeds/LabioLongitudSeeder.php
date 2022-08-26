<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LabioLongitudSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('LABIOLONGITUDDESCR' => 'GRANDE'),
            array('LABIOLONGITUDDESCR' => 'MEDIANA'),
            array('LABIOLONGITUDDESCR' => 'PEQUEÑA'),


        ];
        $this->db->table('LABIOLONGITUD')->insertBatch($data);
    }
}
