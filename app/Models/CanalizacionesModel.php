<?php

namespace App\Models;

use CodeIgniter\Model;

class CanalizacionesModel extends Model
{
	protected $table = "CANALIZACIONES";
	protected $allowedFields    = [
		'INSTITUCIONREMISIONID',
		'INSTITUCIONREMISIONDESCR',
		'MUNICIPIOID',
		'DOMICILIO',
		'TELEFONO',
	];

	public function getByMunicipioId($id)
	{
		$sql = 'SELECT * FROM CANALIZACIONES LEFT JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = CANALIZACIONES.MUNICIPIOID AND MUNICIPIO.ESTADOID = 2 WHERE CANALIZACIONES.MUNICIPIOID = ' . $id;
		$query =  $this->db->query($sql);

		return $query->getResultObject();
	}
}
