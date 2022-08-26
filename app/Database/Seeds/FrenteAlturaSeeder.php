<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FrenteAlturaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('FRENTEALTURADESCR' => 'GRANDE'),
            array('FRENTEALTURADESCR' => 'MEDIANA'),
            array('FRENTEALTURADESCR' => 'PEQUEÑA'),



        ];
        $this->db->table('FRENTEALTURA')->insertBatch($data);
    }
}
