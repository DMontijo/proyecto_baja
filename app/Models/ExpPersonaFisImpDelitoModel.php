<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpPersonaFisImpDelitoModel extends Model
{
    protected $DBGroup          = 'default';
	protected $table            = 'EXPPERSONAFISIMPDELITO';
	protected $allowedFields    = ['FOLIOID','ANO','PERSONAFISICAID','DELITOMODALIDADID','DELITOCARACTERISTICAID','TENTATIVA'];
	public function get_by_folio($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['EXPPERSONAFISIMPDELITO.FOLIOID', 'EXPPERSONAFISIMPDELITO.ANO', 'EXPPERSONAFISIMPDELITO.PERSONAFISICAID', 'EXPPERSONAFISIMPDELITO.DELITOMODALIDADID', 'NOMBRE', 'PRIMERAPELLIDO','DELITOMODALIDADDESCR']);
		$builder->where('EXPPERSONAFISIMPDELITO.FOLIOID', $folio);
		$builder->where('EXPPERSONAFISIMPDELITO.ANO', $year);
		$builder->join('FOLIOPERSONAFISICA', 'FOLIOPERSONAFISICA.PERSONAFISICAID =' . $this->table . '.PERSONAFISICAID');
		$builder->join('DELITOMODALIDAD', 'DELITOMODALIDAD.DELITOMODALIDADID =' . $this->table . '.DELITOMODALIDADID');
		$builder->orderBy('DELITOMODALIDADID', 'ASC');

		$query = $builder->get();
		return $query->getResult('array');
	}

}
