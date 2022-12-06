<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaNacionalidadModel extends Model
{

	protected $table            = 'PERSONANACIONALIDAD';
	protected $primaryKey       = 'PERSONANACIONALIDADID';
	protected $allowedFields    = [
		'PERSONANACIONALIDADID',
		'PERSONANACIONALIDADDESCR'
	];
}
