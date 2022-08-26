<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BigoteTamanoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('BIGOTETAMANODESCR' => 'CORTO'),
            array('BIGOTETAMANODESCR' => 'LARGO'),
            array('BIGOTETAMANODESCR' => 'REGULAR'),
            array('BIGOTETAMANODESCR' => 'NINGUNA'),


        ];
        $this->db->table('BIGOTETAMANO')->insertBatch($data);
    }
}
