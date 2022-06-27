<?php

namespace App\Models;

use CodeIgniter\Model;

class CanalizacionesModel extends Model
{
	protected $table = "CANALIZACIONES_ATENCION";
	protected $primarykey = "ID";
	protected $allowedFields    = [
		'MUNICIPIO',
		'INSTITUCIONREMISIONID',
		'INSTITUCIONREMISIONDESCR',
		'DOMICILIO',
		'TELEFONO',
	];
}
