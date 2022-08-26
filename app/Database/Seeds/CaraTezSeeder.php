<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CaraTezSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CARATEZDESCR'=>'OSCURA'),
            array('CARATEZDESCR'=>'NEGRA'),
            array('CARATEZDESCR'=>'PÁLIDA'),
            array('CARATEZDESCR'=>'ROSADA'),
            array('CARATEZDESCR'=>'TRIGUEÑA OSCURA'),
            array('CARATEZDESCR'=>'TRIGUEÑA CLARA'),
            array('CARATEZDESCR'=>'PECOSA'),
            array('CARATEZDESCR'=>'MANCHADA'),
            array('CARATEZDESCR'=>'LUNARES'),
            array('CARATEZDESCR'=>'VARIÓLICO'),
            array('CARATEZDESCR'=>'NINGUNA'),
		
		];
		$this->db->table('CARATEZ')->insertBatch($data);

    }
}
