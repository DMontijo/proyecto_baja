<?php

namespace App\Models;

use CodeIgniter\Model;

class ColoniasModel extends Model
{

	protected $table            = 'COLONIA';
	protected $allowedFields    = [
		'ESTADOID', 'MUNICIPIOID', 'LOCALIDADID', 'COLONIAID', 'COLONIADESCR'
	];
}
