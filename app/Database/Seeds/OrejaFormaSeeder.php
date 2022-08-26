<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrejaFormaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('OREJAFORMADESCR' => 'CUADRADA'),
            array('OREJAFORMADESCR' => 'OVALADA'),
            array('OREJAFORMADESCR' => 'REDONDA'),
            array('OREJAFORMADESCR' => 'TRIANGULAR'),



        ];
        $this->db->table('OREJAFORMA')->insertBatch($data);
    }
}
