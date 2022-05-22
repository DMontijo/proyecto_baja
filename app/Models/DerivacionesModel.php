<?php

namespace App\Models;

use CodeIgniter\Model;

class DerivacionesModel extends Model
{
	protected $table = "DERIVACIONES_ATENCION";
	protected $primarykey = "ID";
	protected $allowedFields    = [
		'MUNICIPIO',
		'INSTITUCIONREMISIONID',
		'INSTITUCIONREMISIONDESCR',
		'DOMICILIO',
		'TELEFONO',
	];
}
