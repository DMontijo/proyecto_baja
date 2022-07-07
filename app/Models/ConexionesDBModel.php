<?php

namespace App\Models;

use CodeIgniter\Model;

class ConexionesDBModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'CONEXIONESDB';
	protected $allowedFields    = [
		'TYPE',
		'ESTADOID',
		'MUNICIPIOID',
		'USER',
		'PASSWORD',
		'IP',
		'INSTANCE',
		'SCHEMA',
	];
}
