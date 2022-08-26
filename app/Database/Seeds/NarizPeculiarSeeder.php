<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NarizPeculiarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('NARIZPECULIARDESCR' => 'TORCIDA'),
            array('NARIZPECULIARDESCR' => 'PUNTIAGUDA'),
            array('NARIZPECULIARDESCR' => 'FOSAS VISIBLE'),
            array('NARIZPECULIARDESCR' => 'NINGUNA'),


        ];
        $this->db->table('NARIZPECULIAR')->insertBatch($data);
    }
}
