<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CejaFormaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CEJAFORMADESCR'=>'ARQUEADAS'),
            array('CEJAFORMADESCR'=>'ARQUEADAS SINUOSAS'),
            array('CEJAFORMADESCR'=>'RECTILINEAS'),
            array('CEJAFORMADESCR'=>'RECTILINEAS SINUOSAS'),
	
		];
		$this->db->table('CEJAFORMA')->insertBatch($data);

    }
}
