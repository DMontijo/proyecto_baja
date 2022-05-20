<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaNacionalidadModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'CATEGORIA_PERSONANACIONALIDAD';
	protected $primaryKey       = 'PERSONANACIONALIDADID';
	protected $allowedFields    = [
		'PERSONANACIONALIDADID',
		'PERSONANACIONALIDADDESCR'
	];
}
