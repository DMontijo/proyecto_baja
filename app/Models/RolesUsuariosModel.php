<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesUsuariosModel extends Model
{

	protected $table            = 'ROLES';
	protected $allowedFields    = ['ID', 'NOMBRE_ROL'];
}
