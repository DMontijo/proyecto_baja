<?php

namespace App\Models;

use CodeIgniter\Model;

class LocalidadesModel extends Model
{

	protected $table = 'LOCALIDAD';
	protected $allowedFields = [
		'ESTADOID',
		'MUNICIPIOID',
		'LOCALIDADID',
		'LOCALIDADDESCR',
		'ZONA',
	];
}
