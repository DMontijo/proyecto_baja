<?php

namespace App\Models;

use CodeIgniter\Model;

class CanalizacionesModel extends Model
{
	protected $table = "CANALIZACIONES";
	protected $allowedFields    = [
		'MUNICIPIOID',
		'INSTITUCIONREMISIONID',
		'INSTITUCIONREMISIONDESCR',
		'DOMICILIO',
		'TELEFONO',
	];
}
