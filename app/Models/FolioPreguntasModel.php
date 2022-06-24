<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioPreguntasModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIOPREGUNTASDENUNCIA';
	protected $allowedFields    = [
		'FOLIOID',
		'ES_MENOR',
		'ES_TERCERA_EDAD',
		'ES_OFENDIDO',
		'TIENE_DISCAPACIDAD',
		'ES_GRUPO_VULNERABLE',
		'ES_GRUPO_VULNERABLE_DESCR',
		'FUE_CON_ARMA',
		'LESIONES',
		'LESIONES_VISIBLES',
		'ESTA_DESAPARECIDO',
	];
}
