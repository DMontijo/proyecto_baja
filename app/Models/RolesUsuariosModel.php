<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesUsuariosModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'ROLES';
	protected $allowedFields    = [
		'ID' => [
			'type' => 'INT',
			'unsigned' => TRUE,
			'auto_increment' => TRUE,
		],
		'NOMBRE_ROL' => [
			'type' => 'VARCHAR',
			'constraint' => '100',
		],
	];
}
