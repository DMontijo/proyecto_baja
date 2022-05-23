<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
	protected $table = "USUARIOS";
	protected $primarykey = "ID_USUARIO";
	// protected $allowedFields    = [
	// 	'MUNICIPIO',
	// 	'INSTITUCIONREMISIONID',
	// 	'INSTITUCIONREMISIONDESCR',
	// 	'DOMICILIO',
	// 	'TELEFONO',
	// ];

	public function login($data)
	{
		return $this->db->table('USUARIOS')->where($data)->get()->getResultArray();
	}
}
