<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarbaPeculiarSeeder extends Seeder
{
    public function run()
    {
        $data = [
			array('BARBAPECULIARDESCR' => 'RALA'),
			array('BARBAPECULIARDESCR' => 'TUPIDA'),
			array('BARBAPECULIARDESCR' => 'CANOSA'),
			array('BARBAPECULIARDESCR' => 'ENTRECANO'),
			array('BARBAPECULIARDESCR' => 'RASURADA'),
			array('BARBAPECULIARDESCR' => 'BARBILLA'),
			array('BARBAPECULIARDESCR' => 'UNIDA BIGOTE'),
            array('BARBAPECULIARDESCR' => 'NINGUNA'),

		
		];
		$this->db->table('BARBAPECULIAR')->insertBatch($data);

    }
}
