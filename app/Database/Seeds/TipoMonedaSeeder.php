<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoMonedaSeeder extends Seeder
{
    public function run()
    {
        $data = [
			array('TIPOMONEDAID'=>'1','TIPOMONEDADESCR' => 'PESO'),
			array('TIPOMONEDAID'=>'2','TIPOMONEDADESCR' => 'DOLAR'),
			array('TIPOMONEDAID'=>'3','TIPOMONEDADESCR' => 'EURO'),
			array('TIPOMONEDAID'=>'4','TIPOMONEDADESCR' => 'LIBRA ESTERLINA'),
			array('TIPOMONEDAID'=>'5','TIPOMONEDADESCR' => 'QUETZAL'),
            array('TIPOMONEDAID'=>'6','TIPOMONEDADESCR' => 'CORDOVA'),
            array('TIPOMONEDAID'=>'7','TIPOMONEDADESCR' => 'COLON COSTARRICENSE'),
            array('TIPOMONEDAID'=>'8','TIPOMONEDADESCR' => 'BALBOA'),
            array('TIPOMONEDAID'=>'9','TIPOMONEDADESCR' => 'OTROS'),
            array('TIPOMONEDAID'=>'10','TIPOMONEDADESCR' => 'LEMPIRA'),
            array('TIPOMONEDAID'=>'11','TIPOMONEDADESCR' => 'YEN'),

		];
		$this->db->table('TIPOMONEDA')->insertBatch($data);
    }
}
