<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
	protected $table = "USUARIOS";
	protected $primarykey = "ID";
	protected $allowedFields = [
		'ROLID',
		'ZONAID',
		'MUNICIPIOID',
		'OFICINAID',
		'MUNICIPIOSOFICINASID',
		'NOMBRE',
		'APELLIDO_PATERNO',
		'APELLIDO_MATERNO',
		'SEXO',
		'CORREO',
		'PASSWORD',
		'TOKENVIDEO',
	];
}
