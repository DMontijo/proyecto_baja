<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitantesConstanciaModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'SOLICITANTESCONSTANCIA';
	protected $primaryKey       = 'SOLICITANTEID';
	protected $allowedFields    = [
		'SOLICITANTEID',
		'NOMBRE',
		'APELLIDO_PATERNO',
		'APELLIDO_MATERNO',
		'CORREO',
		'PASSWORD',
		'FECHANACIMIENTO',
		'SEXO',
		'TELEFONO',
	];
}
