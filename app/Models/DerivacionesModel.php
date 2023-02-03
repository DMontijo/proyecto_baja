<?php

namespace App\Models;

use CodeIgniter\Model;

class DerivacionesModel extends Model
{
	protected $table = "DERIVACIONES";
	protected $allowedFields    = [
		'INSTITUCIONREMISIONID',
		'INSTITUCIONREMISIONDESCR',
		'MUNICIPIOID',
		'DOMICILIO',
		'TELEFONO',
	];

	public function getByMunicipioId($id)
	{
		$sql = 'SELECT * FROM DERIVACIONES LEFT JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = DERIVACIONES.MUNICIPIOID AND MUNICIPIO.ESTADOID = 2 WHERE DERIVACIONES.MUNICIPIOID = ' . $id;
		$query =  $this->db->query($sql);

		return $query->getResultObject();
	}
}
