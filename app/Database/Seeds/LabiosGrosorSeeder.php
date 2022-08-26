<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LabiosGrosorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('LABIOGROSORDESCR' => 'DELGADOS'),
            array('LABIOGROSORDESCR' => 'MEDIANOS'),
            array('LABIOGROSORDESCR' => 'GRUESOS'),
            array('LABIOGROSORDESCR' => 'MORRUDOS'),



        ];
        $this->db->table('LABIOGROSOR')->insertBatch($data);
    }
}
