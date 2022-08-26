<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PielColorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('PIELCOLORDESCR' => 'ALBINO'),
            array('PIELCOLORDESCR' => 'BLANCO'),
            array('PIELCOLORDESCR' => 'AMARILLO'),
            array('PIELCOLORDESCR' => 'MORENO CLARO'),
            array('PIELCOLORDESCR' => 'MORENO'),
            array('PIELCOLORDESCR' => 'MORENO OSCURO'),
            array('PIELCOLORDESCR' => 'NEGRO'),
            array('PIELCOLORDESCR' => 'OTRO'),


        ];
        $this->db->table('PIELCOLOR')->insertBatch($data);
    }
}
