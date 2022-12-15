<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaTipoIdentificacionModel extends Model
{

	protected $table            = 'PERSONATIPOIDENTIFICACION';
	protected $allowedFields    = [
		'PERSONATIPOIDENTIFICACIONID',
		'PERSONATIPOIDENTIFICACIONDESCR',
		'FORMATOCAPTURA',
		'IDENTIFICACIONPREDETERMINADA',
		'EXPRESIONREGULAR',
	];
}
