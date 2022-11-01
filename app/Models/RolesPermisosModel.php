<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesPermisosModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ROLESPERMISOS';   
    protected $allowedFields    = ['ROLID','PERMISOID'];

}
