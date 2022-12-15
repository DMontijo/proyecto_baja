<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioPersonaFisImpDelitoModel extends Model
{

	protected $table            = 'FOLIOPERSONAFISIMPDELITO';
	protected $allowedFields    = ['FOLIOID', 'ANO', 'PERSONAFISICAID', 'DELITOMODALIDADID', 'DELITOCARACTERISTICAID', 'TENTATIVA'];
	public function get_by_folio($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOPERSONAFISICA.FOLIOID', 'FOLIOPERSONAFISICA.ANO', 'FOLIOPERSONAFISICA.PERSONAFISICAID', 'FOLIOPERSONAFISIMPDELITO.DELITOMODALIDADID', 'NOMBRE', 'PRIMERAPELLIDO', 'DELITOMODALIDADDESCR']);
		$builder->where('FOLIOPERSONAFISICA.FOLIOID', $folio);
		$builder->where('FOLIOPERSONAFISICA.ANO', $year);
		$builder->where('FOLIOPERSONAFISICA.CALIDADJURIDICAID', 2);
		$builder->where('FOLIOPERSONAFISIMPDELITO.FOLIOID', $folio);
		$builder->where('FOLIOPERSONAFISIMPDELITO.ANO', $year);
		$builder->join('FOLIOPERSONAFISICA', 'FOLIOPERSONAFISICA.PERSONAFISICAID =' . $this->table . '.PERSONAFISICAID');
		$builder->join('DELITOMODALIDAD', 'DELITOMODALIDAD.DELITOMODALIDADID =' . $this->table . '.DELITOMODALIDADID');
		$builder->orderBy('DELITOMODALIDADID', 'ASC');

		$query = $builder->get();
		return $query->getResult('array');
	}
	public function count_delitos($folio, $year, $delito)
	{

		// $sql = 'SELECT COUNT(DELITOMODALIDADID) FROM FOLIOPERSONAFISIMPDELITO WHERE FOLIOID =' . $folio .'AND ANO='. $year;
		// $query =  $this->db->query($sql);

		// return $query->getRow();
		$builder = $this->db->table($this->table);
		$builder->selectCount('DELITOMODALIDADID');
		$builder->where('FOLIOID', $folio);
		$builder->where('ANO', $year);
		$builder->where('DELITOMODALIDADID', $delito);

		$query = $builder->get();
		return $query->getResult();
	}
}
