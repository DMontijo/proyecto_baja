<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EstomagoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('ESTOMAGODESCR' => 'FLOJO'),
            array('ESTOMAGODESCR' => 'FUERTE'),
            array('ESTOMAGODESCR' => 'ESCASO'),
            array('ESTOMAGODESCR' => 'PLANO'),
            array('ESTOMAGODESCR' => 'ABULTADO'),
            array('ESTOMAGODESCR' => 'SEMIABULTADO'),
            array('ESTOMAGODESCR' => 'NINGUNA.'),



        ];
        $this->db->table('ESTOMAGO')->insertBatch($data);
    }
}
