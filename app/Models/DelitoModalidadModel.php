<?php

namespace App\Models;

use App\Database\Migrations\FOLIO;
use CodeIgniter\Model;

class DelitoModalidadModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'DELITOMODALIDAD';
	protected $allowedFields    = ['DELITOMODALIDADID','DELITOMODALIDADDESCR','DELITOMODALIDADARTICULO','DELITOCAPITULOID','DELITOCLASIFICACION','DELITOPERSONAL','HABILITADO','DELITOPESO','INTENCIONALIDADID','TIPOQUERELLA'];
	public function get_delitodescr($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['DELITOMODALIDADDESCR', 'DELITOMODALIDAD.DELITOMODALIDADID']);
		$builder->join('FOLIOPERSONAFISIMPDELITO', 'FOLIOPERSONAFISIMPDELITO.DELITOMODALIDADID =' . $this->table . '.DELITOMODALIDADID');
		$builder->where('FOLIOID', $folio);
		$builder->where('ANO', $year);
		$builder->orderBy('FOLIOPERSONAFISIMPDELITO.DELITOMODALIDADID', 'ASC');

		$query = $builder->get();
		return $query->getResult('array');
	}
}
