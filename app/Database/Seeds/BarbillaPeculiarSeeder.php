<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarbillaPeculiarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('BARBILLAPECULIARDESCR' => 'HOYUELOS'),
            array('BARBILLAPECULIARDESCR' => 'BARBILLA PARTIDA'),
            array('BARBILLAPECULIARDESCR' => 'DOBLE BARBILLA'),
            array('BARBILLAPECULIARDESCR' => 'NINGUNA'),



        ];
        $this->db->table('BARBILLAPECULIAR')->insertBatch($data);
    }
}
