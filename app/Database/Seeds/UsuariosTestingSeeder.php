<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuariosTestingSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('ROLID' => '1', 'ZONAID' => '1', 'NOMBRE' => 'ABDIEL OTONIEL', 'APELLIDO_PATERNO' => 'FLORES', 'APELLIDO_MATERNO' => 'GONZALEZ', 'SEXO' => 'M', 'CORREO' => 'otoniel.f@yocontigo-it.com', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu', 'TOKENVIDEO' => 'be001939-8727-46b9-ad21-d89acf4a5b2a', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '1', 'ZONAID' => '1', 'NOMBRE' => 'ANDREA GUADALUPE', 'APELLIDO_PATERNO' => 'SOLORZANO', 'APELLIDO_MATERNO' => 'GUTIERREZ', 'SEXO' => 'F', 'CORREO' => 'andrea.solorzano@yocontigo-it.com', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu', 'TOKENVIDEO' => '4a4c4e42-1f73-4f95-a687-32b6db8eaf98', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '1', 'ZONAID' => '1', 'NOMBRE' => 'SUPER', 'APELLIDO_PATERNO' => 'USUARIO', 'APELLIDO_MATERNO' => 'TEST', 'SEXO' => 'M', 'CORREO' => 'superusuairo@test.com', 'PASSWORD' => '$2y$10$y4k.LQ27fEjQVghghbxKy.D2mexqDrbw7cmUPgVqa8xKxiS5ztDPu', 'TOKENVIDEO' => 'ba18767a-5f6e-4fa6-941f-d4d4198007ad', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '2', 'ZONAID' => '1', 'NOMBRE' => 'DIRECTOR', 'APELLIDO_PATERNO' => 'JAP', 'APELLIDO_MATERNO' => 'TEST', 'SEXO' => 'M', 'CORREO' => 'directorsejap@test.com', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '95dd99ed-0b09-4f1e-8f4b-70e7cb090a8e', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '2', 'ZONAID' => '1', 'NOMBRE' => 'SONIA', 'APELLIDO_PATERNO' => 'LOPEZ', 'APELLIDO_MATERNO' => 'URREA', 'SEXO' => 'F', 'CORREO' => 'sonia.lopez@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'c7b9ed87-f623-4f7a-aade-2d9b8889ef19', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '3', 'ZONAID' => '1', 'NOMBRE' => 'AGENTE', 'APELLIDO_PATERNO' => 'MINISTERIO PUBLICO', 'APELLIDO_MATERNO' => 'TEST', 'SEXO' => 'M', 'CORREO' => 'agentemp@test.com', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'e587f212-3c7b-466d-b3f6-0d84a8674367', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '3', 'ZONAID' => '2', 'NOMBRE' => 'ALEJANDRO', 'APELLIDO_PATERNO' => 'DEL BOSQUE', 'APELLIDO_MATERNO' => 'PARDO', 'SEXO' => 'M', 'CORREO' => 'alejandro.bosque@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'eb104383-5f6a-40fe-b3ab-20fd9d420be5', 'MUNICIPIOID' => 2, 'OFICINAID' => 394),
			array('ROLID' => '3', 'ZONAID' => '2', 'NOMBRE' => 'ANTONIO', 'APELLIDO_PATERNO' => 'LOPEZ', 'APELLIDO_MATERNO' => 'CASTILLO', 'SEXO' => 'M', 'CORREO' => 'antonio.lopez@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '7ec9fb97-4862-4619-ba94-c5624ea17b79', 'MUNICIPIOID' => 2, 'OFICINAID' => 394),
			array('ROLID' => '3', 'ZONAID' => '1', 'NOMBRE' => 'BERNARDO', 'APELLIDO_PATERNO' => 'ORCI', 'APELLIDO_MATERNO' => 'VIESCA', 'SEXO' => 'M', 'CORREO' => 'bernardo.orci@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'cec36c8c-014a-479a-9ab7-bf47f32a880e', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '3', 'ZONAID' => '1', 'NOMBRE' => 'CESAR HUMBERTO', 'APELLIDO_PATERNO' => 'ACEBO', 'APELLIDO_MATERNO' => 'GUTIERREZ', 'SEXO' => 'M', 'CORREO' => 'cesarh.acebo@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '64b70ced-8da2-44bb-a890-481379f8c102', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '3', 'ZONAID' => '1', 'NOMBRE' => 'CINTYA MAGALY', 'APELLIDO_PATERNO' => 'GONZALEZ', 'APELLIDO_MATERNO' => 'REYES', 'SEXO' => 'F', 'CORREO' => 'cintyam.gonzalez@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '90eb5930-2608-4bad-b74f-fcf2075dc837', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '3', 'ZONAID' => '1', 'NOMBRE' => 'FERNANDO', 'APELLIDO_PATERNO' => 'TAPIA', 'APELLIDO_MATERNO' => 'TORRES', 'SEXO' => 'M', 'CORREO' => 'fernando.tapia@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'd8af28fe-17bb-48ba-85b2-cb91c24d3072', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '3', 'ZONAID' => '1', 'NOMBRE' => 'ITZEL', 'APELLIDO_PATERNO' => 'VERDUGO', 'APELLIDO_MATERNO' => 'QUEZADA', 'SEXO' => 'F', 'CORREO' => 'itzela.verdugo@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'dcb826ee-2e69-4a37-afc6-645447e3e3f9', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '3', 'ZONAID' => '2', 'NOMBRE' => 'JORGE ALBERTO', 'APELLIDO_PATERNO' => 'DUEÑAS', 'APELLIDO_MATERNO' => 'OTERO', 'SEXO' => 'M', 'CORREO' => 'jorgea.duenas@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '90e8efd1-eb17-4394-8edb-138b733dc53e', 'MUNICIPIOID' => 2, 'OFICINAID' => 394),
			array('ROLID' => '3', 'ZONAID' => '1', 'NOMBRE' => 'JOSE', 'APELLIDO_PATERNO' => 'CERVANTES', 'APELLIDO_MATERNO' => 'KIRK', 'SEXO' => 'M', 'CORREO' => 'jose.cervantes@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'c40d92a7-b5fa-4585-b6f2-8abf5ee273e4', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '3', 'ZONAID' => '1', 'NOMBRE' => 'JOSE DE JESUS', 'APELLIDO_PATERNO' => 'GARCIA', 'APELLIDO_MATERNO' => 'ZAMORA', 'SEXO' => 'M', 'CORREO' => 'josej.garcia@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '024a460e-de9e-4c6d-a905-599e653d31ca', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '3', 'ZONAID' => '3', 'NOMBRE' => 'JOSUE JOFIEL', 'APELLIDO_PATERNO' => 'PADILLA', 'APELLIDO_MATERNO' => 'CAMPOS', 'SEXO' => 'M', 'CORREO' => 'josuej.padilla@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '4f3485b2-4c65-4b8f-b3cd-a36257cbbc09', 'MUNICIPIOID' => 1, 'OFICINAID' => 792),
			array('ROLID' => '3', 'ZONAID' => '2', 'NOMBRE' => 'LIZETH YAZMIN', 'APELLIDO_PATERNO' => 'TORRES', 'APELLIDO_MATERNO' => 'ANDRADE', 'SEXO' => 'F', 'CORREO' => 'lizethy.torres@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'acc9b53f-22d0-4a96-a5d9-b3f4d87e8458', 'MUNICIPIOID' => 2, 'OFICINAID' => 394),
			array('ROLID' => '3', 'ZONAID' => '1', 'NOMBRE' => 'MARIO ALBERTO', 'APELLIDO_PATERNO' => 'RODRIGUEZ', 'APELLIDO_MATERNO' => 'CASTRO', 'SEXO' => 'M', 'CORREO' => 'marioal.rodriguez@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'b6f6b3a4-53e6-4662-8208-1428e14de57e', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '3', 'ZONAID' => '2', 'NOMBRE' => 'OMAR', 'APELLIDO_PATERNO' => 'TOLEDO', 'APELLIDO_MATERNO' => 'GARCIA', 'SEXO' => 'M', 'CORREO' => 'omar.toledo@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'ae14626f-b355-48b6-a385-684ed1b89a88', 'MUNICIPIOID' => 2, 'OFICINAID' => 394),
			array('ROLID' => '3', 'ZONAID' => '1', 'NOMBRE' => 'PATRICIA', 'APELLIDO_PATERNO' => 'MEDRANO', 'APELLIDO_MATERNO' => 'UREÑA', 'SEXO' => 'F', 'CORREO' => 'patricia.medrano@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '58db9c52-7b90-439f-b4a1-e616001842df', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '3', 'ZONAID' => '1', 'NOMBRE' => 'PATRICIA YANET', 'APELLIDO_PATERNO' => 'CALDERA', 'APELLIDO_MATERNO' => 'CAMPOS', 'SEXO' => 'F', 'CORREO' => 'patriciay.caldera@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '8b2c9c4b-c6d4-4e70-9394-d7fec424b123', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '3', 'ZONAID' => '3', 'NOMBRE' => 'ROBERTO IGNACIO', 'APELLIDO_PATERNO' => 'CASTRO', 'APELLIDO_MATERNO' => 'GALVEZ', 'SEXO' => 'M', 'CORREO' => 'robertoi.castro@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'e404e7fa-2f52-4e65-9644-d9d836d6e42d', 'MUNICIPIOID' => 1, 'OFICINAID' => 792),
			array('ROLID' => '3', 'ZONAID' => '3', 'NOMBRE' => 'VIANNEY', 'APELLIDO_PATERNO' => 'DUARTE', 'APELLIDO_MATERNO' => 'HIGUERA', 'SEXO' => 'F', 'CORREO' => 'vianney.duarte@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '8b114066-67ea-45ed-9bbb-5a2dd8141a31', 'MUNICIPIOID' => 1, 'OFICINAID' => 792),
			array('ROLID' => '3', 'ZONAID' => '1', 'NOMBRE' => 'VIOLETA', 'APELLIDO_PATERNO' => 'GAETA', 'APELLIDO_MATERNO' => 'AGUILAR', 'SEXO' => 'F', 'CORREO' => 'violeta.gaeta@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '9f277367-573e-4cbd-a53a-facbe4e6f583', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '3', 'ZONAID' => '1', 'NOMBRE' => 'YESIKA', 'APELLIDO_PATERNO' => 'GOMEZ', 'APELLIDO_MATERNO' => 'ATIENZO', 'SEXO' => 'F', 'CORREO' => 'yesika.gomez@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '73cb3eee-3e3c-47b8-8cc0-c2c7727c0a7c', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '4', 'ZONAID' => '1', 'NOMBRE' => 'AUXILIAR', 'APELLIDO_PATERNO' => 'MINISTERIO PUBLICO', 'APELLIDO_MATERNO' => 'TEST', 'SEXO' => 'M', 'CORREO' => 'auxiliarmp@test.com', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '032e9ccb-bf0d-4546-aad1-682792990c65', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '4', 'ZONAID' => '2', 'NOMBRE' => 'BERNARDO', 'APELLIDO_PATERNO' => 'VINDIOLA', 'APELLIDO_MATERNO' => 'RODRIGUEZ', 'SEXO' => 'M', 'CORREO' => 'bernardo.vindiola@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'a7f5879d-12b3-4b4f-b4c6-ab8e7e3dfe7a', 'MUNICIPIOID' => 2, 'OFICINAID' => 394),
			array('ROLID' => '4', 'ZONAID' => '3', 'NOMBRE' => 'CRUZ', 'APELLIDO_PATERNO' => 'CANO', 'APELLIDO_MATERNO' => 'JIMENEZ', 'SEXO' => 'M', 'CORREO' => 'cruz.cano@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '5c33cfbe-0e8a-4c8f-a9c0-e2eabfbe0bbf', 'MUNICIPIOID' => 1, 'OFICINAID' => 792),
			array('ROLID' => '4', 'ZONAID' => '1', 'NOMBRE' => 'FRANCISCO DANIEL', 'APELLIDO_PATERNO' => 'COY', 'APELLIDO_MATERNO' => 'MARTINEZ', 'SEXO' => 'M', 'CORREO' => 'franciscod.coy@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '0e8fba67-77c5-44fe-b7eb-3f40fdae4c18', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '4', 'ZONAID' => '2', 'NOMBRE' => 'GIANELLA', 'APELLIDO_PATERNO' => 'ROMERO', 'APELLIDO_MATERNO' => 'CATELLARES', 'SEXO' => 'F', 'CORREO' => 'gianella.romero@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'fd17806b-0439-4b42-a0d6-f254d2a2403c', 'MUNICIPIOID' => 2, 'OFICINAID' => 394),
			array('ROLID' => '5', 'ZONAID' => '1', 'NOMBRE' => 'AGENTE', 'APELLIDO_PATERNO' => 'EXTERNO', 'APELLIDO_MATERNO' => 'TEST', 'SEXO' => 'M', 'CORREO' => 'agenteexterno@test.com', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'e42e78bb-7bf8-4084-aa42-9511357ef601', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '6', 'ZONAID' => '1', 'NOMBRE' => 'CLAUDIA YADIRA', 'APELLIDO_PATERNO' => 'PAEZ', 'APELLIDO_MATERNO' => 'VALENZUELA', 'SEXO' => 'F', 'CORREO' => 'claudiay.paez@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'cf881c3c-4c21-4175-ab0a-596e5545828e', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '6', 'ZONAID' => '1', 'NOMBRE' => 'ENCARGADO', 'APELLIDO_PATERNO' => 'TURNO', 'APELLIDO_MATERNO' => 'TEST', 'SEXO' => 'M', 'CORREO' => 'encargadoturno@test.com', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'fdb1a388-dbf8-4a0a-94fe-79046d9c3f48', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '6', 'ZONAID' => '1', 'NOMBRE' => 'FLOR MARBELLA', 'APELLIDO_PATERNO' => 'CRUZ', 'APELLIDO_MATERNO' => 'REA', 'SEXO' => 'F', 'CORREO' => 'florm.cruz@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'c9753e44-7642-4f7e-89d9-746901bac5e4', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '7', 'ZONAID' => '1', 'NOMBRE' => 'COORDINADOR', 'APELLIDO_PATERNO' => 'TEST', 'APELLIDO_MATERNO' => 'TEST', 'SEXO' => 'M', 'CORREO' => 'coordinador@test.com', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '9e2d0009-8c67-4bba-8e5a-3707c8be72b8', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '7', 'ZONAID' => '1', 'NOMBRE' => 'ISNA DANAHE', 'APELLIDO_PATERNO' => 'MEDEL', 'APELLIDO_MATERNO' => 'RODRIGUEZ', 'SEXO' => 'F', 'CORREO' => 'isnad.medel@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '85e454c6-9f77-46ed-a6e9-f4669d397068', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '8', 'ZONAID' => '1', 'NOMBRE' => 'FACILITADOR', 'APELLIDO_PATERNO' => 'TEST', 'APELLIDO_MATERNO' => 'TEST', 'SEXO' => 'M', 'CORREO' => 'facilitador@test.com', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'ee93dc37-735f-4056-945b-15aeb5ce5acc', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '8', 'ZONAID' => '1', 'NOMBRE' => 'KARLA VANESSA', 'APELLIDO_PATERNO' => 'PARRA', 'APELLIDO_MATERNO' => 'PIZARRO', 'SEXO' => 'F', 'CORREO' => 'karlav.parra@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '5711f687-b6f2-413a-8982-256a425eb778', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '8', 'ZONAID' => '1', 'NOMBRE' => 'ROBERTO CARLOS', 'APELLIDO_PATERNO' => 'VAZQUEZ', 'APELLIDO_MATERNO' => 'SANCHEZ', 'SEXO' => 'M', 'CORREO' => 'robertoc.vazquez@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'ba45a2a9-07b9-4369-88d6-0ded2de9c7d5', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '9', 'ZONAID' => '1', 'NOMBRE' => 'NOTIFICADOR', 'APELLIDO_PATERNO' => 'TEST', 'APELLIDO_MATERNO' => 'TEST', 'SEXO' => 'M', 'CORREO' => 'notificador@test.com', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '2a244f78-96fe-41db-ba9f-b6ae4d7ab50f', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '9', 'ZONAID' => '1', 'NOMBRE' => 'ROSA MARÍA', 'APELLIDO_PATERNO' => 'MAYORQUÍN', 'APELLIDO_MATERNO' => 'MAYORQUÍN', 'SEXO' => 'F', 'CORREO' => 'rosam.mayorquin@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'f279e650-3298-49fe-9d81-1719b1b53a9b', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '10', 'ZONAID' => '1', 'NOMBRE' => 'ANA LUISA', 'APELLIDO_PATERNO' => 'OLVERA', 'APELLIDO_MATERNO' => 'ALVAREZ', 'SEXO' => 'F', 'CORREO' => 'analu.olvera@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'a4aa176d-ecd7-48a9-891d-94684f562958', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '10', 'ZONAID' => '3', 'NOMBRE' => 'LUIS KADZUO', 'APELLIDO_PATERNO' => 'KOTA', 'APELLIDO_MATERNO' => 'VILLAR', 'SEXO' => 'M', 'CORREO' => 'luisk.kota@fgebc.gob.mx', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => 'cbba15cd-01aa-460b-becf-e8dd58b0989e', 'MUNICIPIOID' => 1, 'OFICINAID' => 792),
			array('ROLID' => '10', 'ZONAID' => '1', 'NOMBRE' => 'SECRETARIO', 'APELLIDO_PATERNO' => 'ACUERDOS', 'APELLIDO_MATERNO' => 'TEST', 'SEXO' => 'M', 'CORREO' => 'secretarioacuerdos@test.com', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '6907a5ac-7771-4227-9922-b6a5b312856e', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
			array('ROLID' => '11', 'ZONAID' => '1', 'NOMBRE' => 'INFORMATICA', 'APELLIDO_PATERNO' => 'TEST', 'APELLIDO_MATERNO' => 'TEST', 'SEXO' => 'M', 'CORREO' => 'informatica@test.com', 'PASSWORD' => '$2y$10$OkSCBt05oaEyz8htYZGP/erLWuGg/H0gVlux1LvbpbyE7/f.2e.Aa', 'TOKENVIDEO' => '43de9472-ded1-417b-a457-a0af7dd0893e', 'MUNICIPIOID' => 4, 'OFICINAID' => 924),
		];

		$this->db->table('USUARIOS')->insertBatch($data);
	}
}
