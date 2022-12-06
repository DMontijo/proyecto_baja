<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjetoSubclasificacionModel extends Model
{

	protected $table            = 'OBJETOSUBCLASIFICACION';
	protected $allowedFields    = ['OBJETOCLASIFICACIONID', 'OBJETOSUBCLASIFICACIONID', 'OBJETOSUBCLASIFICACIONDESCR'];
}
