<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
	protected $table = "USUARIOS";
	protected $primarykey = "ID_USUARIO";
	protected $allowedFields = [
		'ROLID',
		'ZONAID',
		'NOMBRE',
		'APELLIDO_PATERNO',
		'APELLIDO_MATERNO',
		'SEXO',
		'CORREO',
		'PASSWORD',
		'TOKENVIDEO',
		'HUELLA_DIGITAL',
		'CERTIFICADOFIRMA',
		'KEYFIRMA',
		'FRASEFIRMA',
	];
}
