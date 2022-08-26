<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CaraTamanoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CARATAMANODESCR' => 'NORMAL'),
            array('CARATAMANODESCR' => 'GRANDE'),
            array('CARATAMANODESCR' => 'PEQUEÑA'),
            array('CARATAMANODESCR' => 'NINGUNA'),



        ];
        $this->db->table('CARATAMANO')->insertBatch($data);
    }
}
