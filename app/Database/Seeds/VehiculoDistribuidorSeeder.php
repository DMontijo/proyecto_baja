<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VehiculoDistribuidorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('VEHICULODISTRIBUIDORID' => '1', 'VEHICULODISTRIBUIDORDESCR' => 'EXTRANJERO'),
            array('VEHICULODISTRIBUIDORID' => '2', 'VEHICULODISTRIBUIDORDESCR' => 'NACIONAL'),

        ];
        $this->db->table('VEHICULODISTRIBUIDOR')->insertBatch($data);
    }
}
