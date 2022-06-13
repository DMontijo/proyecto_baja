<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioDenunciaModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIODENUNCIA';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
		'FOLIOID',
		'DELITO',
		'MUNICIPIO',
		'CALLE',
		'NO_EXTERIOR',
		'NO_INTERIOR',
		'COLONIA',
		'LUGAR',
		'CLASIFICACION',
		'FECHA',
		'HORA',
		'RESPONSABLE',
		'DESCRIPCION_BREVE'
	];
}
