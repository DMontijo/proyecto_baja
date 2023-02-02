<?php

namespace App\Models;

use CodeIgniter\Model;

class DerivacionesModel extends Model
{
	protected $table = "DERIVACIONES";
	protected $allowedFields    = [
		'MUNICIPIOID',
		'INSTITUCIONREMISIONID',
		'INSTITUCIONREMISIONDESCR',
		'DOMICILIO',
		'TELEFONO',
	];

	public function get_by_municipioid($id)
	{
		$sql = 'SELECT d.*, m.MUNICIPIODESCR FROM DERIVACIONES d
			LEFT JOIN MUNICIPIO m ON d.MUNICIPIOID = m.MUNICIPIOID
			WHERE MUNICIPIOID = ' . $id . '
			ORDER BY M.INSTITUCIONREMISIONDESCR ASC
		';
		$query =  $this->db->query($sql);

		var_dump($query);
		exit;

		return $query->getRow();
	}
}
