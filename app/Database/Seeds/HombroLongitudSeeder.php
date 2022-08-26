<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HombroLongitudSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('HOMBROLONGITUDDESCR' => 'LARGOS'),
            array('HOMBROLONGITUDDESCR' => 'CORTOS'),
            array('HOMBROLONGITUDDESCR' => 'MEDIANOS'),
            array('HOMBROLONGITUDDESCR' => 'NINGUNA'),



        ];
        $this->db->table('HOMBROLONGITUD')->insertBatch($data);
    }
}
