<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioCorrelativoModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIOCORRELATIVO';
	protected $allowedFields    = [
		'CORRELATIVO',
		'ESTADOID',
		'MUNICIPIOID',
		'TIPOEXPEDIENTEID',
		'ANO',
	];
}
