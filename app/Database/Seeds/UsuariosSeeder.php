<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuariosSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('ROLID' => '2', 'ZONAID' => '2', 'NOMBRE' => 'SONIA', 'APELLIDO_PATERNO' => 'LOPEZ', 'APELLIDO_MATERNO' => 'URREA', 'SEXO' => 'F', 'CORREO' => 'sonia.lopez@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '3', 'ZONAID' => '4', 'NOMBRE' => 'ISNA DANAHE', 'APELLIDO_PATERNO' => 'MEDEL', 'APELLIDO_MATERNO' => 'RODRIGUEZ', 'SEXO' => 'F', 'CORREO' => 'isnad.mdeel@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '4', 'ZONAID' => '5', 'NOMBRE' => 'FLOR MARBELLA', 'APELLIDO_PATERNO' => 'CRUZ', 'APELLIDO_MATERNO' => 'REA', 'SEXO' => 'F', 'CORREO' => 'florm.cruz@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '4', 'ZONAID' => '3', 'NOMBRE' => 'CLAUDIA', 'APELLIDO_PATERNO' => 'PALACIOS', 'APELLIDO_MATERNO' => 'VEGA', 'SEXO' => 'F', 'CORREO' => 'claudis.palacios@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '5', 'ZONAID' => '6', 'NOMBRE' => 'CESAR HUMBERTO', 'APELLIDO_PATERNO' => 'GUTIERREZ', 'APELLIDO_MATERNO' => 'ACEBO', 'SEXO' => 'M', 'CORREO' => 'cesarh.acebo@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '5', 'ZONAID' => '9', 'NOMBRE' => 'ALEJANDRO', 'APELLIDO_PATERNO' => 'DEL BOSQUE', 'APELLIDO_MATERNO' => 'PARDO', 'SEXO' => 'M', 'CORREO' => 'alejandro.bosque@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '5', 'ZONAID' => '7', 'NOMBRE' => 'JOSE DE JESUS', 'APELLIDO_PATERNO' => 'GARCIA', 'APELLIDO_MATERNO' => 'ZAMORA', 'SEXO' => 'M', 'CORREO' => 'josej.garcia@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '5', 'ZONAID' => '7', 'NOMBRE' => 'CINTHYA MAGALI', 'APELLIDO_PATERNO' => 'GONZALEZ', 'APELLIDO_MATERNO' => 'REYES', 'SEXO' => 'F', 'CORREO' => 'cintyam.gonzalez@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '5', 'ZONAID' => '5', 'NOMBRE' => 'ANDREA', 'APELLIDO_PATERNO' => 'LIRA', 'APELLIDO_MATERNO' => 'CORONA', 'SEXO' => 'F', 'CORREO' => 'andrea.lira@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '5', 'ZONAID' => '8', 'NOMBRE' => 'JOSE JOFIEL', 'APELLIDO_PATERNO' => 'PADILLA', 'APELLIDO_MATERNO' => 'CAMPOS', 'SEXO' => 'M', 'CORREO' => 'josuej.padilla@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '5', 'ZONAID' => '7', 'NOMBRE' => 'CLAUDIA YADIRA', 'APELLIDO_PATERNO' => 'VALENZUELA', 'APELLIDO_MATERNO' => 'PAEZ', 'SEXO' => 'F', 'CORREO' => 'claudiy.paez@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '6', 'ZONAID' => '5', 'NOMBRE' => 'PATRICIA YANET', 'APELLIDO_PATERNO' => 'CALDERA', 'APELLIDO_MATERNO' => 'CAMPOS', 'SEXO' => 'F', 'CORREO' => 'patriciay.caldera@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '6', 'ZONAID' => '7', 'NOMBRE' => 'JOSE', 'APELLIDO_PATERNO' => 'CERVANTES', 'APELLIDO_MATERNO' => 'KIRK', 'SEXO' => 'M', 'CORREO' => 'jose.cervantes@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '6', 'ZONAID' => '7', 'NOMBRE' => 'ISAIAS', 'APELLIDO_PATERNO' => 'CORTEZ', 'APELLIDO_MATERNO' => 'DURAN', 'SEXO' => 'M', 'CORREO' => 'isaias.cortez@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '6', 'ZONAID' => '5', 'NOMBRE' => 'YESENIA', 'APELLIDO_PATERNO' => 'GONZALEZ', 'APELLIDO_MATERNO' => 'ESPARZA', 'SEXO' => 'F', 'CORREO' => 'yeseniais.gonzalez@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '6', 'ZONAID' => '5', 'NOMBRE' => 'CINTHIA JAZMIN', 'APELLIDO_PATERNO' => 'MONFORTE', 'APELLIDO_MATERNO' => 'CERVANTES', 'SEXO' => 'F', 'CORREO' => 'cinthiaj.monforte@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '6', 'ZONAID' => '5', 'NOMBRE' => 'ANA LUISA', 'APELLIDO_PATERNO' => 'OLVERA', 'APELLIDO_MATERNO' => 'ALVAREZ', 'SEXO' => 'F', 'CORREO' => 'analu.olvera@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '6', 'ZONAID' => '5', 'NOMBRE' => 'KARLA VANESA', 'APELLIDO_PATERNO' => 'PARRA', 'APELLIDO_MATERNO' => 'PIZARRO', 'SEXO' => 'F', 'CORREO' => 'karlav.parra@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '6', 'ZONAID' => '9', 'NOMBRE' => 'GIANELLA', 'APELLIDO_PATERNO' => 'ROMERO', 'APELLIDO_MATERNO' => 'CASTELLARES', 'SEXO' => 'F', 'CORREO' => 'gianella.romero@fgebc.gob.mx', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '1', 'ZONAID' => '1', 'NOMBRE' => 'ANDREA', 'APELLIDO_PATERNO' => 'SOLORZANO', 'APELLIDO_MATERNO' => 'GUTIERREZ', 'SEXO' => 'F', 'CORREO' => 'andrea.solorzano@yocontigo-it.com', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
			array('ROLID' => '1', 'ZONAID' => '1', 'NOMBRE' => 'OTONIEL', 'APELLIDO_PATERNO' => 'FLORES', 'APELLIDO_MATERNO' => 'GONZALEZ', 'SEXO' => 'M', 'CORREO' => 'otoniel.f@yocontigo-it.com', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu'),
		];

		$this->db->table('USUARIOS')->insertBatch($data);
	}
}
