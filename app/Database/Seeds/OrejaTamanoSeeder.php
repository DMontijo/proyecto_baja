<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrejaTamanoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('OREJATAMANODESCR' => 'PEQUEÑAS'),
            array('OREJATAMANODESCR' => 'MEDIANAS'),
            array('OREJATAMANODESCR' => 'GRANDES'),
            array('OREJATAMANODESCR' => 'NINGUNA'),

        ];
        $this->db->table('OREJATAMANO')->insertBatch($data);
    }
}
