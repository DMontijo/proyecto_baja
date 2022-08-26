<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BocaTamanoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('BOCATAMANODESCR' => 'GRANDE'),
            array('BOCATAMANODESCR' => 'MEDIANA'),
            array('BOCATAMANODESCR' => 'PEQUEÑA'),


        ];
        $this->db->table('BOCATAMANO')->insertBatch($data);
    }
}
