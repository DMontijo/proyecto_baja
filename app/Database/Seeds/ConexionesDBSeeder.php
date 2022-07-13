<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ConexionesDBSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('TYPE' => 'development', 'ESTADOID' => '2', 'MUNICIPIOID' => '1,', 'USER' => 'VD_PRUEBAS', 'PASSWORD' => 'VD_PRUEBAS', 'IP' => '172.16.200.18', 'INSTANCE' => 'PGJEENS', 'SCHEMA' => 'VD_PRUEBAS'),
			array('TYPE' => 'development', 'ESTADOID' => '2', 'MUNICIPIOID' => '2,', 'USER' => 'VD_PRUEBAS', 'PASSWORD' => 'VD_PRUEBAS', 'IP' => '172.16.24.136', 'INSTANCE' => 'PGJE', 'SCHEMA' => 'VD_PRUEBAS'),
			array('TYPE' => 'development', 'ESTADOID' => '2', 'MUNICIPIOID' => '3,', 'USER' => 'VD_PRUEBAS', 'PASSWORD' => 'VD_PRUEBAS', 'IP' => '172.16.24.136', 'INSTANCE' => 'PGJE', 'SCHEMA' => 'VD_PRUEBAS'),
			array('TYPE' => 'development', 'ESTADOID' => '2', 'MUNICIPIOID' => '4,', 'USER' => 'VD_PRUEBAS', 'PASSWORD' => 'VD_PRUEBAS', 'IP' => '172.16.105.4 ', 'INSTANCE' => 'PGJETIJ ', 'SCHEMA' => 'VD_PRUEBAS'),
			array('TYPE' => 'development', 'ESTADOID' => '2', 'MUNICIPIOID' => '5,', 'USER' => 'VD_PRUEBAS', 'PASSWORD' => 'VD_PRUEBAS', 'IP' => '172.16.105.4 ', 'INSTANCE' => 'PGJETIJ ', 'SCHEMA' => 'VD_PRUEBAS'),
			array('TYPE' => 'development', 'ESTADOID' => '2', 'MUNICIPIOID' => '6,', 'USER' => 'VD_PRUEBAS', 'PASSWORD' => 'VD_PRUEBAS', 'IP' => '172.16.200.18', 'INSTANCE' => 'PGJEENS', 'SCHEMA' => 'VD_PRUEBAS'),
			array('TYPE' => 'development', 'ESTADOID' => '2', 'MUNICIPIOID' => '7,', 'USER' => 'VD_PRUEBAS', 'PASSWORD' => 'VD_PRUEBAS', 'IP' => '172.16.24.136', 'INSTANCE' => 'PGJE', 'SCHEMA' => 'VD_PRUEBAS'),
			array('TYPE' => 'production', 'ESTADOID' => '2', 'MUNICIPIOID' => '1,', 'USER' => 'DBO', 'PASSWORD' => 'dba0wner', 'IP' => '172.16.200.4', 'INSTANCE' => 'PGJEENS', 'SCHEMA' => 'DBO'),
			array('TYPE' => 'production', 'ESTADOID' => '2', 'MUNICIPIOID' => '2,', 'USER' => 'DBO', 'PASSWORD' => 'dba0wner', 'IP' => '172.16.24.150', 'INSTANCE' => 'PGJE', 'SCHEMA' => 'DBO'),
			array('TYPE' => 'production', 'ESTADOID' => '2', 'MUNICIPIOID' => '3,', 'USER' => 'DBO', 'PASSWORD' => 'dba0wner', 'IP' => '172.16.24.150', 'INSTANCE' => 'PGJE', 'SCHEMA' => 'DBO'),
			array('TYPE' => 'production', 'ESTADOID' => '2', 'MUNICIPIOID' => '4,', 'USER' => 'DBO', 'PASSWORD' => 'dba0wner', 'IP' => '172.16.105.56', 'INSTANCE' => 'PGJETIJ ', 'SCHEMA' => 'DBO'),
			array('TYPE' => 'production', 'ESTADOID' => '2', 'MUNICIPIOID' => '5,', 'USER' => 'DBO', 'PASSWORD' => 'dba0wner', 'IP' => '172.16.105.56', 'INSTANCE' => 'PGJETIJ ', 'SCHEMA' => 'DBO'),
			array('TYPE' => 'production', 'ESTADOID' => '2', 'MUNICIPIOID' => '6,', 'USER' => 'DBO', 'PASSWORD' => 'dba0wner', 'IP' => '172.16.200.4', 'INSTANCE' => 'PGJEENS', 'SCHEMA' => 'DBO'),
			array('TYPE' => 'production', 'ESTADOID' => '2', 'MUNICIPIOID' => '7,', 'USER' => 'DBO', 'PASSWORD' => 'dba0wner', 'IP' => '172.16.24.150', 'INSTANCE' => 'PGJE', 'SCHEMA' => 'DBO'),
		];
		$this->db->table('CONEXIONESDB')->insertBatch($data);
	}
}
