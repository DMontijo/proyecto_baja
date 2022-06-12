<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VehiculoServicioSeeder extends Seeder
{
    public function run()
    {
        $data = [
			array('VEHICULOSERVICIOID' => '1', 'VEHICULOSERVICIODESCR' => 'PARTICULAR'),
            array('VEHICULOSERVICIOID' => '2', 'VEHICULOSERVICIODESCR' => 'OFICIAL'),
            array('VEHICULOSERVICIOID' => '3', 'VEHICULOSERVICIODESCR' => 'PÚBLICO (ESTATAL Y/O FEDERAL)'),
        ];

		$this->db->table('VEHICULOSERVICIO')->insertBatch($data);       
    }
}
