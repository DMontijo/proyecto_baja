<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FrenteAnchuraSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('FRENTEANCHURADESCR' => 'GRANDE'),
            array('FRENTEANCHURADESCR' => 'MEDIANA'),
            array('FRENTEANCHURADESCR' => 'PEQUEÑA'),


        ];
        $this->db->table('FRENTEANCHURA')->insertBatch($data);
    }
}
