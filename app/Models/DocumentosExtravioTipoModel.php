<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentosExtravioTipoModel extends Model
{

	protected $table            = 'DOCUMENTOSEXTRAVIOTIPO';
	protected $primarykey 		= "DOCUMENTOEXTRAVIOTIPOID";
	protected $allowedFields    = [
		'DOCUMENTOEXTRAVIOTIPODESCR',
		'VISIBLE',
	];
}
