<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CejaColocacionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CEJACOLOCACIONDESCR' => 'INTERNAS'),
            array('CEJACOLOCACIONDESCR' => 'EXTERNAS'),
            array('CEJACOLOCACIONDESCR' => 'HORIZONTAL'),
        ];
        $this->db->table('CEJACOLOCACION')->insertBatch($data);
    }
}
