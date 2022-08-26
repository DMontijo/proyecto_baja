<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OjoFormaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('OJOFORMADESCR' => 'ALARGADOS'),
            array('OJOFORMADESCR' => 'REDONDOS'),
            array('OJOFORMADESCR' => 'OVALES'),



        ];
        $this->db->table('OJOFORMA')->insertBatch($data);
    }
}
