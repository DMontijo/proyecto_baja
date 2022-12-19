<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FolioConsecutivoSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('ANO' => '2022', 'CONSECUTIVO' => '123456789'),
		];

		$this->db->table('FOLIOCONSECUTIVO')->insertBatch($data);
	}
}
