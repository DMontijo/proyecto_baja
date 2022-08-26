<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CejaGrosorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CEJAGROSORDESCR'=>'ALTAS'),
            array('CEJAGROSORDESCR'=>'BAJAS'),
            array('CEJAGROSORDESCR'=>'PROXIMAS'),
            array('CEJAGROSORDESCR'=>'SEPARADAS'),
		];
		$this->db->table('CEJAGROSOR')->insertBatch($data);

    }
}
