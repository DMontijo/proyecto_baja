<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaFisicaParentescoModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIORELACIONPARENTESCO';
	protected $allowedFields    = ['IDRELACION', 'FOLIOID', 'ANO', 'PARENTESCOID', 'PERSONAFISICAID1', 'PERSONAFISICAID2'];

	public function get_personaFisicaUno($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOPERSONAFISICA.PRIMERAPELLIDO', 'FOLIOPERSONAFISICA.SEGUNDOAPELLIDO', 'FOLIOPERSONAFISICA.NOMBRE']);
		$builder->where('FOLIORELACIONPARENTESCO.FOLIOID', $folio);
		$builder->where('FOLIORELACIONPARENTESCO.ANO', $year);
		$builder->join('FOLIOPERSONAFISICA', 'FOLIOPERSONAFISICA.PERSONAFISICAID =' . $this->table . '.PERSONAFISICAID1');
		$query = $builder->get();
		return $query->getResult('array');
	}
	public function get_personaFisicaDos($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOPERSONAFISICA.PRIMERAPELLIDO', 'FOLIOPERSONAFISICA.SEGUNDOAPELLIDO', 'FOLIOPERSONAFISICA.NOMBRE']);
		$builder->where('FOLIORELACIONPARENTESCO.FOLIOID', $folio);
		$builder->where('FOLIORELACIONPARENTESCO.ANO', $year);
		$builder->join('FOLIOPERSONAFISICA', 'FOLIOPERSONAFISICA.PERSONAFISICAID =' . $this->table . '.PERSONAFISICAID2');
		$query = $builder->get();
		return $query->getResult('array');
	}
	public function get_Parentesco($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['PERSONAPARENTESCO.PERSONAPARENTESCODESCR']);
		$builder->where('FOLIORELACIONPARENTESCO.FOLIOID', $folio);
		$builder->where('FOLIORELACIONPARENTESCO.ANO', $year);
		$builder->join('PERSONAPARENTESCO', 'PERSONAPARENTESCO.PERSONAPARENTESCOID =' . $this->table . '.PARENTESCOID');
		$query = $builder->get();
		return $query->getResult('array');
	}
}
