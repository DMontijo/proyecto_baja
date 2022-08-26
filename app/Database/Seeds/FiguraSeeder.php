<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FiguraSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('FIGURADESCR' => 'DELGADA'),
            array('FIGURADESCR' => 'REGULAR'),
            array('FIGURADESCR' => 'ROBUSTA'),
            array('FIGURADESCR' => 'ATLETICA'),
            array('FIGURADESCR' => 'OBESA'),


        ];
        $this->db->table('FIGURA')->insertBatch($data);
    }
}
