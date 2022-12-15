<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjetoClasificacionModel extends Model
{

	protected $table            = 'OBJETOCLASIFICACION';
	protected $allowedFields    = ['OBJETOCLASIFICACIONID', 'OBJETOCLASIFICACIONDESCR'];
}
