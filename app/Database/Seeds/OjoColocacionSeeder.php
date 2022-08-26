<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OjoColocacionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('OJOCOLOCACIONDESCR'=>'SEPARADOS'),
            array('OJOCOLOCACIONDESCR'=>'CERCANOS'),
            array('OJOCOLOCACIONDESCR'=>'JUNTOS'),
            array('OJOCOLOCACIONDESCR'=>'NINGUNA'),
            

		
		];
		$this->db->table('OJOCOLOCACION')->insertBatch($data);

    }
}
