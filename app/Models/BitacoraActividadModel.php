<?php

namespace App\Models;

use CodeIgniter\Model;

class BitacoraActividadModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'BITACORAACTIVIDAD';
	protected $allowedFields    = [
		'ID',
		'USUARIOID',
		'ACCION',
		'NOTAS',
	];
}
