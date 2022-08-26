<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarbillaFormaSeeder extends Seeder
{
    public function run()
    {
        $data=[
            array('BARBILLAFORMADESCR'=>'OVAL'),
            array('BARBILLAFORMADESCR'=>'CUADRADO'),
            array('BARBILLAFORMADESCR'=>'EN PUNTA'),
            
        ];
        $this->db->table('BARBILLAFORMA')->insertBatch($data);
    }
}
