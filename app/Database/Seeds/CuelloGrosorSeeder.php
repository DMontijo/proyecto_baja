<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CuelloGrosorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CUELLOGROSORDESCR' => 'GRUESO'),
            array('CUELLOGROSORDESCR' => 'DELGADO'),
            array('CUELLOGROSORDESCR' => 'REGULAR'),
            array('CUELLOGROSORDESCR' => 'NINGUNA'),



        ];
        $this->db->table('CUELLOGROSOR')->insertBatch($data);
    }
}
