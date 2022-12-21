<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ConstanciaConsecutivoSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('ANO' => '2022', 'CONSECUTIVO' => '123456789'),
			array('ANO' => '2023', 'CONSECUTIVO' => '123456789'),
		];

		$this->db->table('CONSTANCIAEXTRAVIOCONSECUTIVO')->insertBatch($data);
	}
}
