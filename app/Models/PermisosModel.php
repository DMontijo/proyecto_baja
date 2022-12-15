<?php

namespace App\Models;

use CodeIgniter\Model;

class PermisosModel extends Model
{

    protected $table            = 'PERMISOS';
    protected $allowedFields    = ['PERMISOID', 'PERMISODESCR'];
}
