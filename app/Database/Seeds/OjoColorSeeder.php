<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OjoColorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('OJOCOLORDESCR' => 'AZUL'),
            array('OJOCOLORDESCR' => 'CAFÉ CLARO'),
            array('OJOCOLORDESCR' => 'CAFE OSCURO'),
            array('OJOCOLORDESCR' => 'GRIS'),
            array('OJOCOLORDESCR' => 'VERDE'),
            array('OJOCOLORDESCR' => 'OTRO'),



        ];
        $this->db->table('OJOCOLOR')->insertBatch($data);
    }
}
