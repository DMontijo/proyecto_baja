<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BigotePeculiarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('BIGOTEPECULIARDESCR' => 'RECORTADO'),
            array('BIGOTEPECULIARDESCR' => 'PEINADO ABAJO'),
            array('BIGOTEPECULIARDESCR' => 'PEINADO ARRIBA'),
            array('BIGOTEPECULIARDESCR' => 'DESORDEN'),
            array('BIGOTEPECULIARDESCR' => 'CANO'),
            array('BIGOTEPECULIARDESCR' => 'ENTRECANO'),
            array('BIGOTEPECULIARDESCR' => 'NINGUNA'),



        ];
        $this->db->table('BIGOTEPECULIAR')->insertBatch($data);
    }
}
