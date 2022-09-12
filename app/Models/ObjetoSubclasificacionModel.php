<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjetoSubclasificacionModel extends Model
{
    protected $DBGroup          = 'default';
	protected $table            = 'OBJETOSUBCLASIFICACION';
	protected $allowedFields    = ['OBJETOCLASIFICACIONID','OBJETOSUBCLASIFICACIONID','OBJETOSUBCLASIFICACIONDESCR'];

}
