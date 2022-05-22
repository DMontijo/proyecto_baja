<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuariosSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('ID_ROL' => '2', 'ID_ZONA' => '2', 'ID_PERFIL' => '2', 'NOMBRE' => 'SONIA', 'APELLIDO_PATERNO' => 'LOPEZ', 'APELLIDO_MATERNO' => 'URREA', 'SEXO' => 'MUJER', 'CORREO' => 'sonia.lopez@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '3', 'ID_ZONA' => '4', 'ID_PERFIL' => '2', 'NOMBRE' => 'ISNA DANAHE', 'APELLIDO_PATERNO' => 'MEDEL', 'APELLIDO_MATERNO' => 'RODRIGUEZ', 'SEXO' => 'MUJER', 'CORREO' => 'isnad.mdeel@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '4', 'ID_ZONA' => '5', 'ID_PERFIL' => '2', 'NOMBRE' => 'FLOR MARBELLA', 'APELLIDO_PATERNO' => 'CRUZ', 'APELLIDO_MATERNO' => 'REA', 'SEXO' => 'MUJER', 'CORREO' => 'florm.cruz@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '4', 'ID_ZONA' => '3', 'ID_PERFIL' => '2', 'NOMBRE' => 'CLAUDIA', 'APELLIDO_PATERNO' => 'PALACIOS', 'APELLIDO_MATERNO' => 'VEGA', 'SEXO' => ',MUJER', 'CORREO' => 'claudis.palacios@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '5', 'ID_ZONA' => '6', 'ID_PERFIL' => '2', 'NOMBRE' => 'CESAR HUMBERTO', 'APELLIDO_PATERNO' => 'GUTIERREZ', 'APELLIDO_MATERNO' => 'ACEBO', 'SEXO' => 'HOMBRE', 'CORREO' => 'cesarh.acebo@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '5', 'ID_ZONA' => '9', 'ID_PERFIL' => '2', 'NOMBRE' => 'ALEJANDRO', 'APELLIDO_PATERNO' => 'DEL BOSQUE', 'APELLIDO_MATERNO' => 'PARDO', 'SEXO' => 'HOMBRE', 'CORREO' => 'alejandro.bosque@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '5', 'ID_ZONA' => '7', 'ID_PERFIL' => '2', 'NOMBRE' => 'JOSE DE JESUS', 'APELLIDO_PATERNO' => 'GARCIA', 'APELLIDO_MATERNO' => 'ZAMORA', 'SEXO' => 'HOMBRE', 'CORREO' => 'josej.garcia@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '5', 'ID_ZONA' => '7', 'ID_PERFIL' => '2', 'NOMBRE' => 'CINTHYA MAGALI', 'APELLIDO_PATERNO' => 'GONZALEZ', 'APELLIDO_MATERNO' => 'REYES', 'SEXO' => 'MUJER', 'CORREO' => 'cintyam.gonzalez@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '5', 'ID_ZONA' => '5', 'ID_PERFIL' => '2', 'NOMBRE' => 'ANDREA', 'APELLIDO_PATERNO' => 'LIRA', 'APELLIDO_MATERNO' => 'CORONA', 'SEXO' => 'MUJER', 'CORREO' => 'andrea.lira@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '5', 'ID_ZONA' => '8', 'ID_PERFIL' => '2', 'NOMBRE' => 'JOSE JOFIEL', 'APELLIDO_PATERNO' => 'PADILLA', 'APELLIDO_MATERNO' => 'CAMPOS', 'SEXO' => 'HOMBRE', 'CORREO' => 'josuej.padilla@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '5', 'ID_ZONA' => '7', 'ID_PERFIL' => '2', 'NOMBRE' => 'CLAUDIA YADIRA', 'APELLIDO_PATERNO' => 'VALENZUELA', 'APELLIDO_MATERNO' => 'PAEZ', 'SEXO' => 'MUJER', 'CORREO' => 'claudiy.paez@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '6', 'ID_ZONA' => '5', 'ID_PERFIL' => '5', 'NOMBRE' => 'PATRICIA YANET', 'APELLIDO_PATERNO' => 'CALDERA', 'APELLIDO_MATERNO' => 'CAMPOS', 'SEXO' => 'MUJER', 'CORREO' => 'patriciay.caldera@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '6', 'ID_ZONA' => '7', 'ID_PERFIL' => '5', 'NOMBRE' => 'JOSE', 'APELLIDO_PATERNO' => 'CERVANTES', 'APELLIDO_MATERNO' => 'KIRK', 'SEXO' => 'HOMBRE', 'CORREO' => 'jose.cervantes@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '6', 'ID_ZONA' => '7', 'ID_PERFIL' => '5', 'NOMBRE' => 'ISAIAS', 'APELLIDO_PATERNO' => 'CORTEZ', 'APELLIDO_MATERNO' => 'DURAN', 'SEXO' => 'HOMBRE', 'CORREO' => 'isaias.cortez@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '6', 'ID_ZONA' => '5', 'ID_PERFIL' => '5', 'NOMBRE' => 'YESENIA', 'APELLIDO_PATERNO' => 'GONZALEZ', 'APELLIDO_MATERNO' => 'ESPARZA', 'SEXO' => 'MUJER', 'CORREO' => 'yeseniais.gonzalez@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '6', 'ID_ZONA' => '5', 'ID_PERFIL' => '4', 'NOMBRE' => 'CINTHIA JAZMIN', 'APELLIDO_PATERNO' => 'MONFORTE', 'APELLIDO_MATERNO' => 'CERVANTES', 'SEXO' => 'MUJER', 'CORREO' => 'cinthiaj.monforte@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '6', 'ID_ZONA' => '5', 'ID_PERFIL' => '6', 'NOMBRE' => 'ANA LUISA', 'APELLIDO_PATERNO' => 'OLVERA', 'APELLIDO_MATERNO' => 'ALVAREZ', 'SEXO' => 'MUJER', 'CORREO' => 'analu.olvera@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '6', 'ID_ZONA' => '5', 'ID_PERFIL' => '5', 'NOMBRE' => 'KARLA VANESA', 'APELLIDO_PATERNO' => 'PARRA', 'APELLIDO_MATERNO' => 'PIZARRO', 'SEXO' => 'MUJER', 'CORREO' => 'karlav.parra@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '6', 'ID_ZONA' => '9', 'ID_PERFIL' => '3', 'NOMBRE' => 'GIANELLA', 'APELLIDO_PATERNO' => 'ROMERO', 'APELLIDO_MATERNO' => 'CASTELLARES', 'SEXO' => 'MUJER', 'CORREO' => 'gianella.romero@fgebc.gob.mx', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '1', 'ID_ZONA' => '1', 'ID_PERFIL' => '1', 'NOMBRE' => 'ANDREA', 'APELLIDO_PATERNO' => 'SOLORZANO', 'APELLIDO_MATERNO' => 'GUTIERREZ', 'SEXO' => 'MUJER', 'CORREO' => 'andrea.solorzano@yocontigo-it.com', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
			array('ID_ROL' => '1', 'ID_ZONA' => '1', 'ID_PERFIL' => '1', 'NOMBRE' => 'OTONIEL', 'APELLIDO_PATERNO' => 'FLORES', 'APELLIDO_MATERNO' => 'GONZALEZ', 'SEXO' => 'HOMBRE', 'CORREO' => 'abdiel_flores@outlook.com', 'PASSWORD' => '123456', 'HUELLA_DIGITAL' => 'N/D', 'FIRMA_DIGITAL' => 'N/D'),
		];
		$this->db->table('USUARIOS')->insertBatch($data);
	}
}
