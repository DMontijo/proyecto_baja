<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DelitosUsuariosSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('DELITO' => 'ABUSO DE AUTORIDAD', 'IMPORTANCIA' => '2'),
			array('DELITO' => 'ABUSO DE CONFIANZA', 'IMPORTANCIA' => '1'),
			array('DELITO' => 'ABUSO SEXUAL', 'IMPORTANCIA' => '2'),
			array('DELITO' => 'AMENAZAS', 'IMPORTANCIA' => '2'),
			array('DELITO' => 'ALLANAMIENTO DE MORADA', 'IMPORTANCIA' => '2'),
			array('DELITO' => 'CORRUPCIÓN DE MENORES', 'IMPORTANCIA' => '2'),
			array('DELITO' => 'DAÑO A PROPIEDAD AJENA', 'IMPORTANCIA' => '1'),
			array('DELITO' => 'DAÑO A PROPIEDAD AJENA AGRAVADO POR INCENDIO', 'IMPORTANCIA' => '2'),
			array('DELITO' => 'DELITOS CONTRA LA INTIMIDAD Y LA IMAGEN', 'IMPORTANCIA' => '2'),
			array('DELITO' => 'DELITOS ELECTORALES', 'IMPORTANCIA' => '1'),
			array('DELITO' => 'DESPOJO', 'IMPORTANCIA' => '2'),
			array('DELITO' => 'EXTORSIÓN', 'IMPORTANCIA' => '2'),
			array('DELITO' => 'FALSIFICACIÓN DE DOCUMENTOS', 'IMPORTANCIA' => '1'),
			array('DELITO' => 'FRAUDE', 'IMPORTANCIA' => '1'),
			array('DELITO' => 'HOSTIGAMIENTO', 'IMPORTANCIA' => '1'),
			array('DELITO' => 'INCUMPLIMIENTO DE OBLIGACIONES DE ASISTENCIA FAMILIAR', 'IMPORTANCIA' => '1'),
			array('DELITO' => 'LESIONES', 'IMPORTANCIA' => '2'),
			array('DELITO' => 'MALTRATO O CRUELDAD ANIMAL', 'IMPORTANCIA' => '1'),
			array('DELITO' => 'OMISIÓN DE CUIDADO', 'IMPORTANCIA' => '2'),
			array('DELITO' => 'PERSONA DESAPARECIDA', 'IMPORTANCIA' => '2'),
			array('DELITO' => 'PORNOGRAFÍA DE PERSONA MENOR DE 18 AÑOS', 'IMPORTANCIA' => '2'),
			array('DELITO' => 'RESPONSABILIDAD MÉDICA Y TÉCNICA', 'IMPORTANCIA' => '1'),
			array('DELITO' => 'ROBO', 'IMPORTANCIA' => '1'),
			array('DELITO' => 'ROBO A CASA HABITACIÓN', 'IMPORTANCIA' => '1'),
			array('DELITO' => 'ROBO DE EMPLEADO', 'IMPORTANCIA' => '1'),
			array('DELITO' => 'ROBO DE VEHÍCULO', 'IMPORTANCIA' => '1'),
			array('DELITO' => 'SUSTRACCIÓN DE MENORES', 'IMPORTANCIA' => '2'),
			array('DELITO' => 'USURPACIÓN Ó SUPLANTACIÓN DE IDENTIDAD.', 'IMPORTANCIA' => '1'),
			array('DELITO' => 'VIOLENCIA FAMILIAR', 'IMPORTANCIA' => '2'),
		];
		$this->db->table('DELITOSVIDEODENUNCIA')->insertBatch($data);
	}
}