<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EstadosSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('ESTADOID' => '1', 'ESTADODESCR' => 'AGUASCALIENTES'),
			array('ESTADOID' => '2', 'ESTADODESCR' => 'BAJA CALIFORNIA'),
			array('ESTADOID' => '3', 'ESTADODESCR' => 'BAJA CALIFORNIA SUR'),
			array('ESTADOID' => '4', 'ESTADODESCR' => 'CAMPECHE'),
			array('ESTADOID' => '5', 'ESTADODESCR' => 'COAHUILA DE ZARAGOZA'),
			array('ESTADOID' => '6', 'ESTADODESCR' => 'COLIMA'),
			array('ESTADOID' => '7', 'ESTADODESCR' => 'CHIAPAS'),
			array('ESTADOID' => '8', 'ESTADODESCR' => 'CHIHUAHUA'),
			array('ESTADOID' => '9', 'ESTADODESCR' => 'DISTRITO FEDERAL'),
			array('ESTADOID' => '10', 'ESTADODESCR' => 'DURANGO'),
			array('ESTADOID' => '11', 'ESTADODESCR' => 'GUANAJUATO'),
			array('ESTADOID' => '12', 'ESTADODESCR' => 'GUERRERO'),
			array('ESTADOID' => '13', 'ESTADODESCR' => 'HIDALGO'),
			array('ESTADOID' => '14', 'ESTADODESCR' => 'JALISCO'),
			array('ESTADOID' => '15', 'ESTADODESCR' => 'MEXICO'),
			array('ESTADOID' => '16', 'ESTADODESCR' => 'MICHOACAN'),
			array('ESTADOID' => '17', 'ESTADODESCR' => 'MORELOS'),
			array('ESTADOID' => '18', 'ESTADODESCR' => 'NAYARIT'),
			array('ESTADOID' => '19', 'ESTADODESCR' => 'NUEVO LEON'),
			array('ESTADOID' => '20', 'ESTADODESCR' => 'OAXACA'),
			array('ESTADOID' => '21', 'ESTADODESCR' => 'PUEBLA'),
			array('ESTADOID' => '22', 'ESTADODESCR' => 'QUERETARO'),
			array('ESTADOID' => '23', 'ESTADODESCR' => 'QUINTANA ROO'),
			array('ESTADOID' => '24', 'ESTADODESCR' => 'SAN LUIS POTOSI'),
			array('ESTADOID' => '25', 'ESTADODESCR' => 'SINALOA'),
			array('ESTADOID' => '26', 'ESTADODESCR' => 'SONORA'),
			array('ESTADOID' => '27', 'ESTADODESCR' => 'TABASCO'),
			array('ESTADOID' => '28', 'ESTADODESCR' => 'TAMAULIPAS'),
			array('ESTADOID' => '29', 'ESTADODESCR' => 'TLAXCALA'),
			array('ESTADOID' => '30', 'ESTADODESCR' => 'VERACRUZ'),
			array('ESTADOID' => '31', 'ESTADODESCR' => 'YUCATAN'),
			array('ESTADOID' => '32', 'ESTADODESCR' => 'ZACATECAS'),
			array('ESTADOID' => '33', 'ESTADODESCR' => 'EXTRANJERO')
		];

		//  $this->db->query("INSERT INTO ESTADO (ESTADODESCR) VALUES(:ESTADODESCR:)", $data);
		$this->db->table('ESTADO')->insertBatch($data);
	}
}
