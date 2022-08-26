<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NarizTamanoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('NARIZTAMANODESCR' => 'GRANDE'),
            array('NARIZTAMANODESCR' => 'MEDIANA'),
            array('NARIZTAMANODESCR' => 'PEQUEÑA'),



        ];
        $this->db->table('NARIZTAMANO')->insertBatch($data);
    }
}
