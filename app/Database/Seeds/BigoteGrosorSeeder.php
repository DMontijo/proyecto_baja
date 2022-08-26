<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BigoteGrosorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('BIGOTEGROSORDESCR'=>'GRUESO'),
            array('BIGOTEGROSORDESCR'=>'DELGADO'),
            array('BIGOTEGROSORDESCR'=>'REGULAR'),
            array('BIGOTEGROSORDESCR'=>'NINGUNA'),
		];
		$this->db->table('BIGOTEGROSOR')->insertBatch($data);
    }
}
