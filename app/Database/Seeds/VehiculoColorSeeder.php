<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VehiculoColorSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('VEHICULOCOLORDESCR' => 'CAFE'),
			array('VEHICULOCOLORDESCR' => 'BLANCO'),
			array('VEHICULOCOLORDESCR' => 'AZUL'),
			array('VEHICULOCOLORDESCR' => 'GUINDA'),
			array('VEHICULOCOLORDESCR' => 'NEGRO'),
			array('VEHICULOCOLORDESCR' => 'DORADO'),
			array('VEHICULOCOLORDESCR' => 'VERDE'),
			array('VEHICULOCOLORDESCR' => 'AMARILLO'),
			array('VEHICULOCOLORDESCR' => 'MORADO'),
			array('VEHICULOCOLORDESCR' => 'GRIS'),
			array('VEHICULOCOLORDESCR' => 'ROJO'),
			array('VEHICULOCOLORDESCR' => 'ANARANJADO'),
			array('VEHICULOCOLORDESCR' => 'ROSA'),
			array('VEHICULOCOLORDESCR' => 'MARRON'),
			array('VEHICULOCOLORDESCR' => 'PLATEADO'),
			array('VEHICULOCOLORDESCR' => 'CREMA'),
			array('VEHICULOCOLORDESCR' => 'ALMENDRA'),
			array('VEHICULOCOLORDESCR' => 'ZAFIRO'),
			array('VEHICULOCOLORDESCR' => 'PEWTER'),
			array('VEHICULOCOLORDESCR' => 'CASTAÑO'),
			array('VEHICULOCOLORDESCR' => 'BRONCE'),
			array('VEHICULOCOLORDESCR' => 'AZUL MARINO'),
			array('VEHICULOCOLORDESCR' => 'MULTIPLES COLORES'),
			array('VEHICULOCOLORDESCR' => 'ARENA'),
			array('VEHICULOCOLORDESCR' => 'OTRO'),

		];
		$this->db->table('VEHICULOCOLOR')->insertBatch($data);
	}
}
