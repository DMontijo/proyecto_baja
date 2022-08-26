<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FrentePeculiarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('FRENTEPECULIARDESCR' => 'ARRUGAS HORIONTALES'),
            array('FRENTEPECULIARDESCR' => 'ARRUGAS VERTICALES'),
            array('FRENTEPECULIARDESCR' => 'CEÑO PERMANENTE'),
            array('FRENTEPECULIARDESCR' => 'NINGUNA'),



        ];
        $this->db->table('FRENTEPECULIAR')->insertBatch($data);
    }
}
