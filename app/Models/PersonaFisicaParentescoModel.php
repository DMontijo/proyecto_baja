<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaFisicaParentescoModel extends Model
{

	protected $table            = 'FOLIORELACIONPARENTESCO';
	protected $allowedFields    = ['FOLIOID', 'ANO', 'PARENTESCOID', 'PERSONAFISICAID1', 'PERSONAFISICAID2'];

	public function getRelacion($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['P1.NOMBRE AS NOMBREP1', 'FOLIORELACIONPARENTESCO.PERSONAFISICAID1 AS IDP1', 'PARENTESCOID','PERSONAPARENTESCODESCR','P2.NOMBRE AS NOMBREP2', 'FOLIORELACIONPARENTESCO.PERSONAFISICAID2 AS IDP2']);
		$builder->where('FOLIORELACIONPARENTESCO.FOLIOID', $folio);
		$builder->where('FOLIORELACIONPARENTESCO.ANO', $year);
		$builder->where('P1.FOLIOID', $folio);
		$builder->where('P1.ANO', $year);

		$builder->where('P2.FOLIOID', $folio);
		$builder->where('P2.ANO', $year);
		$builder->join('FOLIOPERSONAFISICA AS P1', 'P1.PERSONAFISICAID =' . $this->table . '.PERSONAFISICAID1');
		$builder->join('FOLIOPERSONAFISICA AS P2', 'P2.PERSONAFISICAID =' . $this->table . '.PERSONAFISICAID2');
		$builder->join('PERSONAPARENTESCO', 'PERSONAPARENTESCO.PERSONAPARENTESCOID =' . $this->table . '.PARENTESCOID');



		$query = $builder->get();
		return $query->getResult('array');
	}
	public function get_personaFisicaDos($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOPERSONAFISICA.PRIMERAPELLIDO', 'FOLIOPERSONAFISICA.SEGUNDOAPELLIDO', 'FOLIOPERSONAFISICA.NOMBRE', 'FOLIORELACIONPARENTESCO.PERSONAFISICAID2']);
		$builder->where('FOLIORELACIONPARENTESCO.FOLIOID', $folio);
		$builder->where('FOLIORELACIONPARENTESCO.ANO', $year);
		$builder->where('FOLIOPERSONAFISICA.FOLIOID', $folio);
		$builder->where('FOLIOPERSONAFISICA.ANO', $year);

		$builder->join('FOLIOPERSONAFISICA', 'FOLIOPERSONAFISICA.PERSONAFISICAID =' . $this->table . '.PERSONAFISICAID2');


		$query = $builder->get();
		return $query->getResult('array');
	}
	public function get_Parentesco($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['PERSONAPARENTESCO.PERSONAPARENTESCODESCR', 'FOLIORELACIONPARENTESCO.PARENTESCOID']);
		$builder->where('FOLIORELACIONPARENTESCO.FOLIOID', $folio);
		$builder->where('FOLIORELACIONPARENTESCO.ANO', $year);
		$builder->join('PERSONAPARENTESCO', 'PERSONAPARENTESCO.PERSONAPARENTESCOID =' . $this->table . '.PARENTESCOID');
		$query = $builder->get();
		return $query->getResult('array');
	}
}
