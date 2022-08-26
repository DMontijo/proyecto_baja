<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CejaTamanoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CEJATAMANODESCR' => 'GRUESAS'),
            array('CEJATAMANODESCR' => 'DELGADAS'),
            array('CEJATAMANODESCR' => 'CORTAS'),
            array('CEJATAMANODESCR' => 'LARGAS'),


        ];
        $this->db->table('CEJATAMANO')->insertBatch($data);
    }
}
