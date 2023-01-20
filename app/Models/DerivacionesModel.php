<?php

namespace App\Models;

use CodeIgniter\Model;

class DerivacionesModel extends Model
{
	protected $table = "DERIVACIONES";
	protected $allowedFields    = [
		'MUNICIPIOID',
		'INSTITUCIONREMISIONID',
		'INSTITUCIONREMISIONDESCR',
		'DOMICILIO',
		'TELEFONO',
	];
}
