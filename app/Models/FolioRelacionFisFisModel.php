<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioRelacionFisFisModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIORELACIONFISFIS';
	protected $allowedFields    = ['FOLIOID', 'ANO', 'PERSONAFISICAIDVICTIMA', 'DELITOMODALIDADID', 'PERSONAFISICAIDIMPUTADO', 'GRADOPARTICIPACIONID', 'TENTATIVA', 'CONVIOLENCIA'];

	public function get_by_folio($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIORELACIONFISFIS.FOLIOID', 'FOLIORELACIONFISFIS.ANO', 'PERSONAFISICAIDVICTIMA', 'FOLIORELACIONFISFIS.DELITOMODALIDADID', 'PERSONAFISICAIDIMPUTADO ', 'VICTIMA.NOMBRE AS NOMBREV', 'VICTIMA.PRIMERAPELLIDO AS PAPELLIDOV', 'VICTIMA.SEGUNDOAPELLIDO AS SAPELLIDOA','IMPUTADO.NOMBRE AS NOMBREI', 'IMPUTADO.PRIMERAPELLIDO AS PAPELLIDOI', 'IMPUTADO.SEGUNDOAPELLIDO AS SAPELLIDOI','DELITOMODALIDADDESCR']);
		$builder->where('FOLIORELACIONFISFIS.FOLIOID', $folio);
		$builder->where('FOLIORELACIONFISFIS.ANO', $year);
		$builder->where('VICTIMA.FOLIOID', $folio);
		$builder->where('VICTIMA.ANO', $year);
		$builder->join('FOLIOPERSONAFISICA AS VICTIMA', 'VICTIMA.PERSONAFISICAID =' . $this->table . '.PERSONAFISICAIDVICTIMA');
		$builder->join('FOLIOPERSONAFISICA AS IMPUTADO', 'IMPUTADO.PERSONAFISICAID =' . $this->table . '.PERSONAFISICAIDIMPUTADO');
		$builder->join('DELITOMODALIDAD', 'DELITOMODALIDAD.DELITOMODALIDADID =' . $this->table . '.DELITOMODALIDADID');

		$query = $builder->get();
		return $query->getResult('array');
	}
}
