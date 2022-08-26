<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CabelloColorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CABELLOCOLORDESCR' => 'ALBINO'),
            array('CABELLOCOLORDESCR' => 'CANO TOTAL'),
            array('CABELLOCOLORDESCR' => 'CASTAÑO CLARO'),
            array('CABELLOCOLORDESCR' => 'CASTAÑO OSCURO'),
            array('CABELLOCOLORDESCR' => 'ENTRECANO'),
            array('CABELLOCOLORDESCR' => 'NEGRO'),
            array('CABELLOCOLORDESCR' => 'PELIROJO'),
            array('CABELLOCOLORDESCR' => 'RUBIO'),



        ];
        $this->db->table('CABELLOCOLOR')->insertBatch($data);
    }
}
