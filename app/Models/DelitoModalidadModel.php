<?php

namespace App\Models;

use CodeIgniter\Model;

class DelitoModalidadModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'DELITOMODALIDAD';
	protected $allowedFields    = ['DELITOMODALIDADID','DELITOMODALIDADDESCR','DELITOMODALIDADARTICULO','DELITOCAPITULOID','DELITOCLASIFICACION','DELITOPERSONAL','HABILITADO','DELITOPESO','INTENCIONALIDADID','TIPOQUERELLA'];
	public function get_delitodescr()
	{
		$builder = $this->db->table($this->table);
		$builder->select(['DELITOMODALIDADDESCR', 'DELITOMODALIDAD.DELITOMODALIDADID']);
		$builder->join('EXPPERSONAFISIMPDELITO', 'EXPPERSONAFISIMPDELITO.DELITOMODALIDADID =' . $this->table . '.DELITOMODALIDADID');
		$builder->orderBy('EXPPERSONAFISIMPDELITO.DELITOMODALIDADID', 'ASC');

		$query = $builder->get();
		return $query->getResult('array');
	}
}
