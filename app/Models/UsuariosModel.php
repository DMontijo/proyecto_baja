<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
	protected $table = "USUARIOS";
	protected $primarykey = "ID_USUARIO";
	protected $allowedFields = [];
}
