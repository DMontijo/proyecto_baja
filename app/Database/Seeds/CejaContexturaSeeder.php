<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CejaContexturaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CONTEXTURADESCR' => 'FUERTE'),
            array('CONTEXTURADESCR' => 'REGULAR'),
            array('CONTEXTURADESCR' => 'DÉBIL'),
            array('CONTEXTURADESCR' => 'NINGUNA'),



        ];
        $this->db->table('CEJACONTEXTURA')->insertBatch($data);
    }
}
