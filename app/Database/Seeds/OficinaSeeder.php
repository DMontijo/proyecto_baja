<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OficinaSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('OFICINAID' => '793', 'OFICINADESCR' => 'CDTEC - ENSENADA', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '409', 'OFICINADESCR' => 'CDTEC - MEXICALI', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '409', 'OFICINADESCR' => 'CDTEC - TECATE', 'ESTADOID' => '2', 'MUNICIPIOID' => '3'),
			array('OFICINAID' => '924', 'OFICINADESCR' => 'CDTEC - TIJUANA', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '924', 'OFICINADESCR' => 'CDTEC - PLAYAS DE ROSARITO', 'ESTADOID' => '2', 'MUNICIPIOID' => '5'),

			//COORDINACIONES
			array('OFICINAID' => '701', 'OFICINADESCR' => 'COORDINACION CON DETENIDO ENSENADA', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '703', 'OFICINADESCR' => 'COORDINACION U.I. FORANEAS', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '709', 'OFICINADESCR' => 'COORDINACION DE ROBO', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '713', 'OFICINADESCR' => 'DIRECCION REGIONAL DE LA FISCALÍA ESPECIALIZADA DE DELITOS CONTRA LA VIDA', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '715', 'OFICINADESCR' => 'COORDINACION DE U.I. SAN QUINTIN', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '717', 'OFICINADESCR' => 'COORDINACION DE DELITOS CONTRA EL PATRIMONIO Y LA SOC', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '719', 'OFICINADESCR' => 'COORDINACION UTMC', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '747', 'OFICINADESCR' => 'COORDINACION DE VISITADURIA ENSENADA', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '749', 'OFICINADESCR' => 'COORDINACION DE NARCOMENUDEO ENSENADA', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '753', 'OFICINADESCR' => 'COORDINACION DE TRATA DE PERSONAS ENSENADA', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '770', 'OFICINADESCR' => 'COORDINACION ESTATAL DE ANTISECUESTROS', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '773', 'OFICINADESCR' => 'COORDINACION DE ROBO DE VEHICULOS', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '774', 'OFICINADESCR' => 'COORDINACION DE BUSQUEDA DE PERSONAS NO LOCALIZADAS', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '776', 'OFICINADESCR' => 'COORDINACION CONTRA LA LIBERTAD SEXUAL Y FAMILIAR', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '778', 'OFICINADESCR' => 'COORDINACION DE LA FISCALIA ESP. EN DELITOS DE TORTURA', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '781', 'OFICINADESCR' => 'COORD DE DELITOS DE PERSONAS Y SU LIBERTAD', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '787', 'OFICINADESCR' => 'COORDINACION DE LA UNIDAD DE DELITOS ELECTORALES', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '790', 'OFICINADESCR' => 'COORDINACION DE LA FISCALIA ESPECIAL DE LA FGE', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '52', 'OFICINADESCR' => 'COORDINACION B - U.I. DE DELITOS CONTRA LAS PERSONAS Y SU LIBERTAD', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '54', 'OFICINADESCR' => 'COORDINACION D - U.I. DE DELITOS DE ROBO DE VEHICULO', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '55', 'OFICINADESCR' => 'COORDINACION E - U.I. DE DELITOS DE ROBO', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '57', 'OFICINADESCR' => 'COORDINACION F - U.I. DE DELITOS CONTRA EL PATRIMONIO, SOCIEDAD, ESTADO Y JUSTICIA', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '58', 'OFICINADESCR' => 'COORDINACION H - U.I. DE DELITOS CON DETENIDO ORIENTE', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '73', 'OFICINADESCR' => 'COORDINACION G - U.I. DE DELITOS CON DETENIDO PONIENTE', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '108', 'OFICINADESCR' => 'DIRECCION DE ASUNTOS INTERNOS', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '168', 'OFICINADESCR' => 'COORDINACION A - U.I. DE DELITOS CONTRA LA VIDA Y LA INTEGRIDAD', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '300', 'OFICINADESCR' => 'COORDINACION U - UTMC', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '308', 'OFICINADESCR' => 'COORDINACION K (GUADALUPE VICTORIA)', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '309', 'OFICINADESCR' => 'COORD L (CIUDAD MORELOS)', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '310', 'OFICINADESCR' => 'COORDINACION N - SAN FELIPE', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '346', 'OFICINADESCR' => 'COORDINACION DE NARCOMENUDEO', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '374', 'OFICINADESCR' => 'COORDINACION DE DELITOS DE TRATA DE PERSONAS', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '382', 'OFICINADESCR' => 'COORDINACION EN INV Y PERSECUCION DE DELITOS DE DESAPARICION FORZADA DE PERSONAS Y COMETIDA POR PART', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '386', 'OFICINADESCR' => 'COORDINACION DE LA FISCALIA ESP. EN DELITOS DE TORTURA', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '394', 'OFICINADESCR' => 'COORDINACION DE UNIDADES DE VIOLENCIA FAMILIAR', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '395', 'OFICINADESCR' => 'COORDINACION DE LA UNIDAD DE DELITOS SEXUALES', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '397', 'OFICINADESCR' => 'COORDINACION DE LA UNIDAD DE DELITOS ELECTORALES', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '400', 'OFICINADESCR' => 'COORDINACION DE LA FISCALIA ESPECIAL DE LA FGE (MEXICALI)', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '372', 'OFICINADESCR' => 'COORDINACION DE ATENCION AL DELITO DE SECUESTRO', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '312', 'OFICINADESCR' => 'COORDINACION DE DELITOS CON DETENIDO', 'ESTADOID' => '2', 'MUNICIPIOID' => '3'),
			array('OFICINAID' => '316', 'OFICINADESCR' => 'COORDINACION DE DELITOS SIN DETENIDO TECATE, B.C.', 'ESTADOID' => '2', 'MUNICIPIOID' => '3'),
			array('OFICINAID' => '389', 'OFICINADESCR' => 'COORDINACION DE LA FISCALIA ESP. EN DELITOS DE TORTURA ZONA TECATE', 'ESTADOID' => '2', 'MUNICIPIOID' => '3'),
			array('OFICINAID' => '392', 'OFICINADESCR' => 'COORDINACION DE U.I. DE DELITOS CONTRA LA LIBERTAD SEXUAL Y FAMILIA', 'ESTADOID' => '2', 'MUNICIPIOID' => '3'),
			array('OFICINAID' => '408', 'OFICINADESCR' => 'COORDINACION DE VISITADURIA ZONA TECATE', 'ESTADOID' => '2', 'MUNICIPIOID' => '3'),
			array('OFICINAID' => '410', 'OFICINADESCR' => 'COORD.CONTRA LA VIDA Y LA INTEGRIDAD TECATE', 'ESTADOID' => '2', 'MUNICIPIOID' => '3'),
			array('OFICINAID' => '801', 'OFICINADESCR' => 'COORDINACION DE UNIDADES DE INVESTIGACION CON DETENIDO', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '808', 'OFICINADESCR' => 'COORDINACION DE U.I. ESPECIALIZADAS EN DELITOS PATRIMONIALES', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '810', 'OFICINADESCR' => 'COORDINACION DE U.I. ZONA MARIANO MATAMOROS', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '812', 'OFICINADESCR' => 'COORDINACION DE U.I. ESPECIALIZADA EN ROBO DE VEHICULOS', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '833', 'OFICINADESCR' => 'COORDINACION ESTATAL DE ATENCIONAL DELITO DE NARCOMENUDEO TIJUANA', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '835', 'OFICINADESCR' => 'COORDINACION DE LA UNIDAD ESPECIALIZADA EN COMBATE AL SECUESTRO', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '838', 'OFICINADESCR' => 'COORDINACION DE U.I. ESPECIALIZADA EN DELITOS SEXUALES', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '840', 'OFICINADESCR' => 'COORDINACION DE UNIDADES DE INVESTIGACION ZONA CENTRO', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '846', 'OFICINADESCR' => 'COORDINACION DE UNIDADES DE INVESTIGACION ZONA LA MESA', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '848', 'OFICINADESCR' => 'COORDINACION DE U.I. ESPECIALIZADA EN ROBOS ZONA LA MESA', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '856', 'OFICINADESCR' => 'COORD DE U.I. ESPECIALIZADAS CONTRA LA VIDA Y LA INTEGRIDAD', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '875', 'OFICINADESCR' => 'COORDINACION ESTATAL DE INVESTIGACION DE BUSQUEDA DE DE DE PERSONAS NO LOCALIZADAS', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '876', 'OFICINADESCR' => 'JEFATURA DE VISITADURIA', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '883', 'OFICINADESCR' => 'COORDINACION ESTATAL DE TRATA DE PERSONAS', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '892', 'OFICINADESCR' => 'COORDINACION DE LA FISCALIA ESP. EN DELITOS DE TORTURA', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '906', 'OFICINADESCR' => 'COORDINACION DE U.I. DE DELITOS DE VIOLENCIA FAMILIAR', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '911', 'OFICINADESCR' => 'COORDINACION DE LA UNIDAD DE DELITOS ELECTORALES', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '920', 'OFICINADESCR' => 'COORDINACION DE LA FISCALIA ESPECIAL DE LA FGE', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '894', 'OFICINADESCR' => 'COORDINACION DE UNIDADES ZONA ROSARITO', 'ESTADOID' => '2', 'MUNICIPIOID' => '5'),
			array('OFICINAID' => '902', 'OFICINADESCR' => 'COORDINACION ESPECIALIZADA EN DELITOS CONTRA LA VIDA', 'ESTADOID' => '2', 'MUNICIPIOID' => '5'),
			array('OFICINAID' => '905', 'OFICINADESCR' => 'COORDINACION DE U.I. DE DELITOS CONTRA LA LIBERTAD SEXUAL Y FAMILIA', 'ESTADOID' => '2', 'MUNICIPIOID' => '5'),
			array('OFICINAID' => '917', 'OFICINADESCR' => 'COORDINACION ESPECIALIZADA EN DELITOS CONTRA EL NARCOMENUDEO RTO', 'ESTADOID' => '2', 'MUNICIPIOID' => '5'),
			array('OFICINAID' => '922', 'OFICINADESCR' => 'COORDINACION DE VISITADURIA ZONA RTO', 'ESTADOID' => '2', 'MUNICIPIOID' => '5'),

			array('OFICINAID' => '932', 'OFICINADESCR' => 'UNIDAD DE INVESTIGACION ESPECIALIZADA EN ROBOS OTAY', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '844', 'OFICINADESCR' => 'COORDINACION DE DELITOS CONTRA ROBOS', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),

		];
		$this->db->table("OFICINA")->insertBatch($data);
	}
}
