<?php

namespace App\Models;

use CodeIgniter\Model;

class DenunciaModel extends Model

{   

	protected $DBGroup          = 'default';
	protected $table            = 'DENUNCIA';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
		'ES_MENOR',
		'ERES_TU',
		'ES_TERCERA_EDAD',
		'TIENE_DISCAPACIDAD',
		'FUE_CON_ARMA',
		'ESTA_DESAPARECIDO',
	];

}