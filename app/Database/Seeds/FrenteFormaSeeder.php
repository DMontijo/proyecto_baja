<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FrenteFormaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('FRENTEFORMADESCR' => 'OBLICUA'),
            array('FRENTEFORMADESCR' => 'INTERMEDIA'),
            array('FRENTEFORMADESCR' => 'VERTICAL'),
            array('FRENTEFORMADESCR' => 'PROMINENTE'),



        ];
        $this->db->table('FRENTEFORMA')->insertBatch($data);
    }
}
