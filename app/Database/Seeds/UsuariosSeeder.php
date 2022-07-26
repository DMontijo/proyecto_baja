<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuariosSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array(
				'ROLID' => '2',
				'ZONAID' => '2',
				'NOMBRE' => 'SONIA',
				'APELLIDO_PATERNO' => 'LOPEZ',
				'APELLIDO_MATERNO' => 'URREA',
				'SEXO' => 'F',
				'CORREO' => 'sonia.lopez@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '24',
				'TOKENVIDEO' => '198429b7cc8a2a5733d97bc13153227dd5017555'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '3',
				'NOMBRE' => 'PATRICIA YANET',
				'APELLIDO_PATERNO' => 'CALDERA',
				'APELLIDO_MATERNO' => 'CAMPOS',
				'SEXO' => 'F',
				'CORREO' => 'patriciay.caldera@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '37',
				'TOKENVIDEO' => 'efea09bd7bde0d5783422ece661367b7eeafb357'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '3',
				'NOMBRE' => 'FLOR MARBELLA',
				'APELLIDO_PATERNO' => 'CRUZ',
				'APELLIDO_MATERNO' => 'REA',
				'SEXO' => 'F',
				'CORREO' => 'florm.cruz@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '26',
				'TOKENVIDEO' => 'c6a4a36430d039664c709293716f36ace2f7380e'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '3',
				'NOMBRE' => 'JOSE RAMON',
				'APELLIDO_PATERNO' => 'GONZALEZ',
				'APELLIDO_MATERNO' => 'RODRIGUEZ ',
				'SEXO' => 'M',
				'CORREO' => 'joser.gonzalez@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '27',
				'TOKENVIDEO' => 'f4c0280457b451e343be8ea9ebc5062e2fceff77'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '3',
				'NOMBRE' => 'ANDREA',
				'APELLIDO_PATERNO' => 'LIRA',
				'APELLIDO_MATERNO' => 'CORONA',
				'SEXO' => 'F',
				'CORREO' => 'andrea.lira@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '34',
				'TOKENVIDEO' => 'a282154a464054841535b821b3b115c56afa5502'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '3',
				'NOMBRE' => 'ISNA DANAHE',
				'APELLIDO_PATERNO' => 'MEDEL',
				'APELLIDO_MATERNO' => 'RODRIGUEZ ',
				'SEXO' => 'F',
				'CORREO' => 'isnad.medel@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '25',
				'TOKENVIDEO' => 'f3dae474c932a9641680211a8f13e59d1d38a145'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '3',
				'NOMBRE' => 'CLAUDIA YADIRA',
				'APELLIDO_PATERNO' => 'PAEZ',
				'APELLIDO_MATERNO' => 'VALENZUELA',
				'SEXO' => 'F',
				'CORREO' => 'claudiay.paez@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '36',
				'TOKENVIDEO' => '4f37d8c624292bd7a4eaed4c5d08562838cde1a6'
			),
			array(
				'ROLID' => '3',
				'ZONAID' => '3',
				'NOMBRE' => 'YESENIA ISABEL',
				'APELLIDO_PATERNO' => 'GONZALEZ',
				'APELLIDO_MATERNO' => 'ESPARZA',
				'SEXO' => 'F',
				'CORREO' => 'yeseniais.gonzalez@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '39',
				'TOKENVIDEO' => '652b226f69789741576360c1df3b58f3aa778b32'
			),
			array(
				'ROLID' => '3',
				'ZONAID' => '3',
				'NOMBRE' => 'KARLA VANESSA',
				'APELLIDO_PATERNO' => 'PARRA',
				'APELLIDO_MATERNO' => 'PIZARRO',
				'SEXO' => 'F',
				'CORREO' => 'karlav.parra@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '41',
				'TOKENVIDEO' => '8bffa1a43d7fe29f60333c919d68bc228bee176e'
			),
			array(
				'ROLID' => '4',
				'ZONAID' => '3',
				'NOMBRE' => 'ROSA MARÍA',
				'APELLIDO_PATERNO' => 'MAYORQUÍN',
				'APELLIDO_MATERNO' => 'MAYORQUÍN',
				'SEXO' => 'F',
				'CORREO' => 'rosam.mayorquin@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '35',
				'TOKENVIDEO' => '1fdec1fc5bb5170ac7d47542a506e0e72668a660'
			),
			array(
				'ROLID' => '5',
				'ZONAID' => '3',
				'NOMBRE' => 'ANA LUISA',
				'APELLIDO_PATERNO' => 'OLVERA',
				'APELLIDO_MATERNO' => 'ALVAREZ',
				'SEXO' => 'F',
				'CORREO' => 'analu.olvera@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '40',
				'TOKENVIDEO' => 'e485adb382aa8db2810f05cd3fac9f888706310f'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '4',
				'NOMBRE' => 'JOSE    ',
				'APELLIDO_PATERNO' => 'CERVANTES',
				'APELLIDO_MATERNO' => 'KIRK',
				'SEXO' => 'M',
				'CORREO' => 'jose.cervantes@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '38',
				'TOKENVIDEO' => '7e68d87c3f767267089ce3f6cb0d813ee0ab7200'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '4',
				'NOMBRE' => 'ISAIAS',
				'APELLIDO_PATERNO' => 'CORTEZ',
				'APELLIDO_MATERNO' => 'DURAN',
				'SEXO' => 'M',
				'CORREO' => 'isaias.cortez@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '31',
				'TOKENVIDEO' => '250f6482ead5499d6641a9ccf86ee3ba29f580b4'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '4',
				'NOMBRE' => 'JOSE DE JESUS',
				'APELLIDO_PATERNO' => 'GARCIA',
				'APELLIDO_MATERNO' => 'ZAMORA',
				'SEXO' => 'M',
				'CORREO' => 'josej.garcia@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '32',
				'TOKENVIDEO' => '1d16fb6e027429391085adf58ca0960a783b18a0'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '4',
				'NOMBRE' => 'CINTYA MAGALY',
				'APELLIDO_PATERNO' => 'GONZALEZ',
				'APELLIDO_MATERNO' => 'REYES',
				'SEXO' => 'F',
				'CORREO' => 'cintyam.gonzalez@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '33',
				'TOKENVIDEO' => '7b2a0523176a9dd9f28b694b44de4d5a4edcff31'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '4',
				'NOMBRE' => 'ITZEL ',
				'APELLIDO_PATERNO' => 'VERDUGO',
				'APELLIDO_MATERNO' => 'QUEZADA',
				'SEXO' => 'F',
				'CORREO' => 'itzela.verdugo@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '45',
				'TOKENVIDEO' => 'c07842fea064b08385e9ec27de5946a9dce3098f'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '5',
				'NOMBRE' => 'CESAR HUMBERTO',
				'APELLIDO_PATERNO' => 'ACEBO',
				'APELLIDO_MATERNO' => 'GUTIERREZ',
				'SEXO' => 'M',
				'CORREO' => 'cesarh.acebo@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '28',
				'TOKENVIDEO' => '91f42fd54949636fa278e66e6a5509821ecb07f9'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '6',
				'NOMBRE' => 'JOSUE JOFIEL',
				'APELLIDO_PATERNO' => 'PADILLA',
				'APELLIDO_MATERNO' => 'CAMPOS',
				'SEXO' => 'M',
				'CORREO' => 'josuej.padilla@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '43',
				'TOKENVIDEO' => '30d7e17636ac3458c25609d2eec1908b94a993dd'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '7',
				'NOMBRE' => 'ALEJANDRO',
				'APELLIDO_PATERNO' => 'DEL BOSQUE',
				'APELLIDO_MATERNO' => 'PARDO',
				'SEXO' => 'M',
				'CORREO' => 'alejandro.bosque@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '44',
				'TOKENVIDEO' => '051bafddf4cd90e5d5cc588f1617fab18edcc1d2'
			),
			array(
				'ROLID' => '2',
				'ZONAID' => '7',
				'NOMBRE' => 'LIZETH YAZMIN',
				'APELLIDO_PATERNO' => 'TORRES',
				'APELLIDO_MATERNO' => 'ANDRADE',
				'SEXO' => 'F',
				'CORREO' => 'lizethy.torres@fgebc.gob.mx',
				'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa',
				'USUARIOVIDEO' => '42',
				'TOKENVIDEO' => '48e3aad162ecf9293daef07ea508cf9a34e852e9'
			),
			array(
				'ROLID' => '1',
				'ZONAID' => '1',
				'NOMBRE' => 'ABDIEL OTONIEL',
				'APELLIDO_PATERNO' => 'FLORES',
				'APELLIDO_MATERNO' => 'GONZALEZ',
				'SEXO' => 'M',
				'CORREO' => 'otoniel.f@yocontigo-it.com',
				'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu',
				'USUARIOVIDEO' => '46',
				'TOKENVIDEO' => 'db295889f70a13b5e5c6b27bfd1f393a51e6029f'
			),
		];

		$this->db->table('USUARIOS')->insertBatch($data);
	}
}
