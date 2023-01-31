<?php

namespace App\Models;

use CodeIgniter\Model;

class SesionesModel extends Model
{

	protected $table            = 'SESIONES';
	protected $allowedFields    = [
		'ID',
		'ID_USUARIO',
		'IP_USUARIO',
		'IP_PUBLICA',
		'AGENTE_HTTP',
		'ACTIVO',

	];
}
