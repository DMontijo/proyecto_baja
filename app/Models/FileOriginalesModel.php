<?php

namespace App\Models;

use CodeIgniter\Model;

class FileOriginalesModel extends Model
{

	protected $table            = 'PLANTILLAS';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
		'ID',
		'DESCRIPCION',
		'TITULO',
		'PLACEHOLDER',
		'TEXTO',
	];
}
