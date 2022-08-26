<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OjoTamanoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('OJOTAMANODESCR' => 'GRANDES'),
            array('OJOTAMANODESCR' => 'PEQUEÑOS'),
            array('OJOTAMANODESCR' => 'REGULARES'),



        ];
        $this->db->table('OJOTAMANO')->insertBatch($data);
    }
}
