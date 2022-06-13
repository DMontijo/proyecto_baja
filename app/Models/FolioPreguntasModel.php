<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioPreguntasModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIOPREGUNTASDENUNCIA';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
		'FOLIOID',
		'ES_MENOR',
		'ERES_TU',
		'ES_TERCERA_EDAD',
		'TIENE_DISCAPACIDAD',
		'FUE_CON_ARMA',
		'ESTA_DESAPARECIDO',
		'LESIONES',
		'LESIONES_VISIBLES',
	];
}
