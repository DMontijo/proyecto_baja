<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CabelloTamanoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CABELLOTAMANODESCR'=>'ABUNDANTE'),
            array('CABELLOTAMANODESCR'=>'ESCASO'),
            array('CABELLOTAMANODESCR'=>'REGULAR'),
            array('CABELLOTAMANODESCR'=>'SIN CABELLO'),
            

		
		];
		$this->db->table('CABELLOTAMANO')->insertBatch($data);

    }
}
