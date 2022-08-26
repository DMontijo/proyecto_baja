<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarbillaInclinacionSeeder extends Seeder
{
    public function run()
    {

        $data = [
            array('BARBILLAINCLINACIONDESCR' => 'HUYENTE'),
            array('BARBILLAINCLINACIONDESCR' => 'PROMINENTE'),
            array('BARBILLAINCLINACIONDESCR' => 'VERTICAL'),



        ];
        $this->db->table('BARBILLAINCLINACION')->insertBatch($data);
    }
}
