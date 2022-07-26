<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EstadosSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('ESTADODESCR' => 'AGUASCALIENTES'),
			array('ESTADODESCR' => 'BAJA CALIFORNIA'),
			array('ESTADODESCR' => 'BAJA CALIFORNIA SUR'),
			array('ESTADODESCR' => 'CAMPECHE'),
			array('ESTADODESCR' => 'COAHUILA DE ZARAGOZA'),
			array('ESTADODESCR' => 'COLIMA'),
			array('ESTADODESCR' => 'CHIAPAS'),
			array('ESTADODESCR' => 'CHIHUAHUA'),
			array('ESTADODESCR' => 'DISTRITO FEDERAL'),
			array('ESTADODESCR' => 'DURANGO'),
			array('ESTADODESCR' => 'GUANAJUATO'),
			array('ESTADODESCR' => 'GUERRERO'),
			array('ESTADODESCR' => 'HIDALGO'),
			array('ESTADODESCR' => 'JALISCO'),
			array('ESTADODESCR' => 'MEXICO'),
			array('ESTADODESCR' => 'MICHOACAN'),
			array('ESTADODESCR' => 'MORELOS'),
			array('ESTADODESCR' => 'NAYARIT'),
			array('ESTADODESCR' => 'NUEVO LEON'),
			array('ESTADODESCR' => 'OAXACA'),
			array('ESTADODESCR' => 'PUEBLA'),
			array('ESTADODESCR' => 'QUERETARO'),
			array('ESTADODESCR' => 'QUINTANA ROO'),
			array('ESTADODESCR' => 'SAN LUIS POTOSI'),
			array('ESTADODESCR' => 'SINALOA'),
			array('ESTADODESCR' => 'SONORA'),
			array('ESTADODESCR' => 'TABASCO'),
			array('ESTADODESCR' => 'TAMAULIPAS'),
			array('ESTADODESCR' => 'TLAXCALA'),
			array('ESTADODESCR' => 'VERACRUZ'),
			array('ESTADODESCR' => 'YUCATAN'),
			array('ESTADODESCR' => 'ZACATECAS'),
			array('ESTADODESCR' => 'EXTRANJERO')
		];

		//  $this->db->query("INSERT INTO ESTADO (ESTADODESCR) VALUES(:ESTADODESCR:)", $data);
		$this->db->table('ESTADO')->insertBatch($data);
	}
}
