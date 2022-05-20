<?php

namespace App\Models;

use CodeIgniter\Model;

class AreaModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'AREA';
	protected $allowedFields    = [
		'AREAID',
		'AREADESCR',
		'DEPENDEAREA',
		'OFICINAID',
		'EMPLEADOIDRESPONSABLEAREA',
		'RESPONSABLEDEOFICINA',
		'AGENDARALASIGNAR'
	];
}
