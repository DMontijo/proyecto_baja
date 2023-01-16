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
		'NOMBRE',
		'APELLIDO_PATERNO',
		'APELLIDO_MATERNO',
		'SEXO',
		'CORREO',
		'PASSWORD',
		'USUARIOVIDEO',
		'TOKENVIDEO',
		'HUELLA_DIGITAL',
		'CERTIFICADOFIRMA',
		'KEYFIRMA',
		'FRASEFIRMA',
	];
}