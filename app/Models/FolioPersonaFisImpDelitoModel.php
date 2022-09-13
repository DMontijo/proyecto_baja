<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioPersonaFisImpDelitoModel extends Model
{
    protected $DBGroup          = 'default';
	protected $table            = 'FOLIOPERSONAFISIMPDELITO';
	protected $allowedFields    = ['FOLIOID','ANO','PERSONAFISICAID','DELITOMODALIDADID','DELITOCARACTERISTICAID','TENTATIVA'];
	public function get_by_folio($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOPERSONAFISIMPDELITO.FOLIOID', 'FOLIOPERSONAFISIMPDELITO.ANO', 'FOLIOPERSONAFISIMPDELITO.PERSONAFISICAID', 'FOLIOPERSONAFISIMPDELITO.DELITOMODALIDADID', 'NOMBRE', 'PRIMERAPELLIDO','DELITOMODALIDADDESCR']);
		$builder->where('FOLIOPERSONAFISIMPDELITO.FOLIOID', $folio);
		$builder->where('FOLIOPERSONAFISIMPDELITO.ANO', $year);
		$builder->join('FOLIOPERSONAFISICA', 'FOLIOPERSONAFISICA.PERSONAFISICAID =' . $this->table . '.PERSONAFISICAID');
		$builder->join('DELITOMODALIDAD', 'DELITOMODALIDAD.DELITOMODALIDADID =' . $this->table . '.DELITOMODALIDADID');
		$builder->orderBy('DELITOMODALIDADID', 'ASC');

		$query = $builder->get();
		return $query->getResult('array');
	}

}
