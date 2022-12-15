<?php

namespace App\Models;

use CodeIgniter\Model;

class HechoLugarModel extends Model
{

	protected $table            = 'HECHOLUGAR';
	protected $allowedFields    = [
		'HECHOLUGARID',
		'HECHODESCR'
	];
}
