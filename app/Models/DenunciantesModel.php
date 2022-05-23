<?php

namespace App\Models;

use CodeIgniter\Model;

class DenunciantesModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'DENUNCIANTES';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
		'NOMBRE',
		'APELLIDO_PATERNO',
		'APELLIDO_MATERNO',
		'CORREO',
		'PASSWORD',
		'PERFIL',
		'CREADO',
		'ACTUALIZADO',
		'ELIMINADO'
	];
}
