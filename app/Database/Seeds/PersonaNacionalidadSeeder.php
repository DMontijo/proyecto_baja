<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PersonaNacionalidadSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('PERSONANACIONALIDADDESCR' => 'AFGANISTAN'),
			array('PERSONANACIONALIDADDESCR' => 'AFRICANA'),
			array('PERSONANACIONALIDADDESCR' => 'ALBANA'),
			array('PERSONANACIONALIDADDESCR' => 'ALEMANA'),
			array('PERSONANACIONALIDADDESCR' => 'ANDORRA'),
			array('PERSONANACIONALIDADDESCR' => 'ANGOLA'),
			array('PERSONANACIONALIDADDESCR' => 'ARABE'),
			array('PERSONANACIONALIDADDESCR' => 'ARGELIA'),
			array('PERSONANACIONALIDADDESCR' => 'ARGENTINA'),
			array('PERSONANACIONALIDADDESCR' => 'AUSTRALIANA'),
			array('PERSONANACIONALIDADDESCR' => 'AUSTRIACA'),
			array('PERSONANACIONALIDADDESCR' => 'BANGLADESH'),
			array('PERSONANACIONALIDADDESCR' => 'BELGA'),
			array('PERSONANACIONALIDADDESCR' => 'BELICEÑA'),
			array('PERSONANACIONALIDADDESCR' => 'BIRMANA'),
			array('PERSONANACIONALIDADDESCR' => 'BOLIVIANA'),
			array('PERSONANACIONALIDADDESCR' => 'BRASILEÑA'),
			array('PERSONANACIONALIDADDESCR' => 'BULGARA'),
			array('PERSONANACIONALIDADDESCR' => 'BURUNDI'),
			array('PERSONANACIONALIDADDESCR' => 'CAMBOYA (KAMPUCHEA)'),
			array('PERSONANACIONALIDADDESCR' => 'CAMERUNESA'),
			array('PERSONANACIONALIDADDESCR' => 'CANADIENSE'),
			array('PERSONANACIONALIDADDESCR' => 'CENTRO AFRICANA (REP.)'),
			array('PERSONANACIONALIDADDESCR' => 'COLOMBIANA'),
			array('PERSONANACIONALIDADDESCR' => 'CONGO (REP.DOM)'),
			array('PERSONANACIONALIDADDESCR' => 'COREANA'),
			array('PERSONANACIONALIDADDESCR' => 'COSTA DE MARFIL'),
			array('PERSONANACIONALIDADDESCR' => 'COSTARICENSE'),
			array('PERSONANACIONALIDADDESCR' => 'CUBANA'),
			array('PERSONANACIONALIDADDESCR' => 'CHAD'),
			array('PERSONANACIONALIDADDESCR' => 'CHILENA'),
			array('PERSONANACIONALIDADDESCR' => 'CHINA COMUNISTA'),
			array('PERSONANACIONALIDADDESCR' => 'CHINA NACIONALISTA (TAIWAN)'),
			array('PERSONANACIONALIDADDESCR' => 'CHIPRE'),
			array('PERSONANACIONALIDADDESCR' => 'DINAMARCA'),
			array('PERSONANACIONALIDADDESCR' => 'DOMINICANA (REP.)'),
			array('PERSONANACIONALIDADDESCR' => 'ECUATORIANA'),
			array('PERSONANACIONALIDADDESCR' => 'EGIPCIA'),
			array('PERSONANACIONALIDADDESCR' => 'SALVADOREÑA'),
			array('PERSONANACIONALIDADDESCR' => 'ESPAÑOLA'),
			array('PERSONANACIONALIDADDESCR' => 'ESTADOUNIDENSE'),
			array('PERSONANACIONALIDADDESCR' => 'ETIOPE'),
			array('PERSONANACIONALIDADDESCR' => 'FILIPINA'),
			array('PERSONANACIONALIDADDESCR' => 'FINLANDESA'),
			array('PERSONANACIONALIDADDESCR' => 'FRANCESA'),
			array('PERSONANACIONALIDADDESCR' => 'GABON'),
			array('PERSONANACIONALIDADDESCR' => 'GAMBIA'),
			array('PERSONANACIONALIDADDESCR' => 'GHANA'),
			array('PERSONANACIONALIDADDESCR' => 'INGLESA'),
			array('PERSONANACIONALIDADDESCR' => 'GRIEGA'),
			array('PERSONANACIONALIDADDESCR' => 'GUATEMALTECA'),
			array('PERSONANACIONALIDADDESCR' => 'GUINEA'),
			array('PERSONANACIONALIDADDESCR' => 'GUYANA'),
			array('PERSONANACIONALIDADDESCR' => 'HAITIANA'),
			array('PERSONANACIONALIDADDESCR' => 'HOLANDESA'),
			array('PERSONANACIONALIDADDESCR' => 'HONDUREÑA'),
			array('PERSONANACIONALIDADDESCR' => 'HUNGARA'),
			array('PERSONANACIONALIDADDESCR' => 'INDU'),
			array('PERSONANACIONALIDADDESCR' => 'INDONESIA'),
			array('PERSONANACIONALIDADDESCR' => 'IRAQUI'),
			array('PERSONANACIONALIDADDESCR' => 'IRANI'),
			array('PERSONANACIONALIDADDESCR' => 'IRLANDESA'),
			array('PERSONANACIONALIDADDESCR' => 'ISLANDIA'),
			array('PERSONANACIONALIDADDESCR' => 'ISRAELI'),
			array('PERSONANACIONALIDADDESCR' => 'ITALIANA'),
			array('PERSONANACIONALIDADDESCR' => 'JAMAIQUINA'),
			array('PERSONANACIONALIDADDESCR' => 'JAPONESA'),
			array('PERSONANACIONALIDADDESCR' => 'JORDANA'),
			array('PERSONANACIONALIDADDESCR' => 'KENIANA'),
			array('PERSONANACIONALIDADDESCR' => 'KUWAITI'),
			array('PERSONANACIONALIDADDESCR' => 'LAOS'),
			array('PERSONANACIONALIDADDESCR' => 'LIBANESA'),
			array('PERSONANACIONALIDADDESCR' => 'LIBERIA'),
			array('PERSONANACIONALIDADDESCR' => 'LIBANESA'),
			array('PERSONANACIONALIDADDESCR' => 'LUXEMBURGO'),
			array('PERSONANACIONALIDADDESCR' => 'MADAGASCAR'),
			array('PERSONANACIONALIDADDESCR' => 'MALAWI'),
			array('PERSONANACIONALIDADDESCR' => 'MALASIA'),
			array('PERSONANACIONALIDADDESCR' => 'MALI'),
			array('PERSONANACIONALIDADDESCR' => 'MARROQUI'),
			array('PERSONANACIONALIDADDESCR' => 'MAURITANA'),
			array('PERSONANACIONALIDADDESCR' => 'MEXICANA'),
			array('PERSONANACIONALIDADDESCR' => 'MONACO'),
			array('PERSONANACIONALIDADDESCR' => 'MOZAMBIQUE'),
			array('PERSONANACIONALIDADDESCR' => 'NEPAL'),
			array('PERSONANACIONALIDADDESCR' => 'NICARAGUENSE'),
			array('PERSONANACIONALIDADDESCR' => 'NIGER'),
			array('PERSONANACIONALIDADDESCR' => 'NIGERIANA'),
			array('PERSONANACIONALIDADDESCR' => 'NORUEGA'),
			array('PERSONANACIONALIDADDESCR' => 'NUEVAZELANDA'),
			array('PERSONANACIONALIDADDESCR' => 'PANAMEÑA'),
			array('PERSONANACIONALIDADDESCR' => 'PAKISTANI'),
			array('PERSONANACIONALIDADDESCR' => 'PARAGUAY'),
			array('PERSONANACIONALIDADDESCR' => 'PERUANA'),
			array('PERSONANACIONALIDADDESCR' => 'POLACA'),
			array('PERSONANACIONALIDADDESCR' => 'PORTUGUESA'),
			array('PERSONANACIONALIDADDESCR' => 'PUERTORIQUENSE'),
			array('PERSONANACIONALIDADDESCR' => 'RUANDESA'),
			array('PERSONANACIONALIDADDESCR' => 'RUMANA'),
			array('PERSONANACIONALIDADDESCR' => 'SENEGAL'),
			array('PERSONANACIONALIDADDESCR' => 'SIERRALEONA'),
			array('PERSONANACIONALIDADDESCR' => 'SIRIA'),
			array('PERSONANACIONALIDADDESCR' => 'SOMALI'),
			array('PERSONANACIONALIDADDESCR' => 'SUDAN'),
			array('PERSONANACIONALIDADDESCR' => 'SUECA'),
			array('PERSONANACIONALIDADDESCR' => 'SUIZA'),
			array('PERSONANACIONALIDADDESCR' => 'SURINAM'),
			array('PERSONANACIONALIDADDESCR' => 'TAILANDESA'),
			array('PERSONANACIONALIDADDESCR' => 'TANZANIA'),
			array('PERSONANACIONALIDADDESCR' => 'TOGO'),
			array('PERSONANACIONALIDADDESCR' => 'TRINIDAD Y TOBAGO'),
			array('PERSONANACIONALIDADDESCR' => 'TUNEZ'),
			array('PERSONANACIONALIDADDESCR' => 'TURCA'),
			array('PERSONANACIONALIDADDESCR' => 'UGANDA'),
			array('PERSONANACIONALIDADDESCR' => 'URUGUAYA'),
			array('PERSONANACIONALIDADDESCR' => 'VATICANO'),
			array('PERSONANACIONALIDADDESCR' => 'VENEZOLANA'),
			array('PERSONANACIONALIDADDESCR' => 'VIETNAMITA'),
			array('PERSONANACIONALIDADDESCR' => 'YEMEN REP.ARABE)'),
			array('PERSONANACIONALIDADDESCR' => 'YEMEN (REP.D.P.)'),
			array('PERSONANACIONALIDADDESCR' => 'ZAIREÑA'),
			array('PERSONANACIONALIDADDESCR' => 'ZAMBIA'),
		];
		$this->db->table('CATEGORIA_PERSONANACIONALIDAD')->insertBatch($data);
	}
}
