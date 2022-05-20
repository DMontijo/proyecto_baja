<?php

namespace App\Models;

use CodeIgniter\Model;

class CiudadanoModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'CIUDADANOS';
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
