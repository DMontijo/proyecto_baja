<?php

namespace App\Models;

use CodeIgniter\Model;

class SesionesDenunciantesModel extends Model
{
    protected $table            = 'SESIONESDENUNCIANTES';
	protected $allowedFields    = [
		'ID',
		'ID_DENUNCIANTE',
		'IP_DENUNCIANTE',
		'IP_PUBLICA',
		'DENUNCIANTE_HTTP',
		'ACTIVO',
		'DENUNCIANTE_SO',
		'DENUNCIANTE_MOBILE',
	];
}
