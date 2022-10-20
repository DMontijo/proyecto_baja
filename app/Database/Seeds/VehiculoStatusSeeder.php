<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VehiculoStatusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('VEHICULOSTATUSID' => '1', 'VEHICULOSTATUSDESCR' => 'ROBADO'),
            array('VEHICULOSTATUSID' => '2', 'VEHICULOSTATUSDESCR' => 'RECUPERADO'),
            array('VEHICULOSTATUSID' => '3', 'VEHICULOSTATUSDESCR' => 'ENTREGADO'),

        ];
        $this->db->table('VEHICULOSTATUS')->insertBatch($data);
    }
}
