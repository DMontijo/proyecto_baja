<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NarizTipoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('NARIZTIPODESCR' => 'CONCAVO'),
            array('NARIZTIPODESCR' => 'CONVEXO'),
            array('NARIZTIPODESCR' => 'RECTO'),
            array('NARIZTIPODESCR' => 'SINUOSO'),


        ];
        $this->db->table('NARIZTIPO')->insertBatch($data);
    }
}
