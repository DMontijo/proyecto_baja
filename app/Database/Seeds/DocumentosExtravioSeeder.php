<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DocumentosExtravioSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'BOLETA DE EMPEÑO', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'BOLETOS DE SORTEOS', 'VISIBLE' => '0'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'CARTILLA DE VACUNACIÓN', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'CARTILLA MILITAR', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'CERTIFICADO DE GRADO ACADEMICO', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'CREDENCIAL DE ELECTOR', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'CREDENCIAL DE INAPAM', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'GAFETE DE TRABAJO', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'LICENCIA DE CONDUCIR', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'PASAPORTE MEXICANO', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'PLACAS DE AUTOMÓVILES NACIONALES Y FRONTERIZAS', 'VISIBLE' => '0'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'TARJETA BANCARIA', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'TARJETA DE AFILIACION A IMSS', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'TARJETA DE AFILIACION A ISSSTE', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'TARJETA DE AFILIACION A ISSSTECALI', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'TARJETA DE CIRCULACIÓN', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'TARJETON DE DISCAPACIDAD', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'VISA LÁSER', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'TARJETÓN PARA INGRESO AL CENTRO DE REINSERCIÓN SOCIAL (VISITANTE)', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'TARJETA/PLANILLA DE BIENESTAR SOCIAL', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'TARJETA SENTRI', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'TARJETA DE RESIDENTE EN ESTADOS UNIDOS DE AMÉRICA', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'TARJETA DE RESIDENCIA EXPEDIDA POR INSTITUTO NACIONAL DE MIGRACIÓN (INAMI)', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'CREDENCIAL DE DISCAPACIDAD', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'VISA HUMANITARIA', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'MATRÍCULA CONSULAR', 'VISIBLE' => '1'),
			array('DOCUMENTOEXTRAVIOTIPODESCR' => 'TARJETA DE IDENTIFICACIÓN AEROPORTUARIA (TIA)', 'VISIBLE' => '1'),
		];
		$this->db->table('DOCUMENTOSEXTRAVIOTIPO')->insertBatch($data);
	}
}
