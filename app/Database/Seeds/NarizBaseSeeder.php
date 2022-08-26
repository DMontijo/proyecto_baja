<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NarizBaseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('NARIZBASEDESCR' => 'ABATIDA'),
            array('NARIZBASEDESCR' => 'HORIZONTAL'),
            array('NARIZBASEDESCR' => 'LEVANTADA'),


        ];
        $this->db->table('NARIZBASE')->insertBatch($data);
    }
}
