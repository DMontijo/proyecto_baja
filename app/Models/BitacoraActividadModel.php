<?php

namespace App\Models;

use CodeIgniter\Model;

class BitacoraActividadModel extends Model
{

	protected $table            = 'BITACORAACTIVIDAD';
	protected $allowedFields    = [
		'ID',
		'USUARIOID',
		'ACCION',
		'NOTAS',
	];
}
