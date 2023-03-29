<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioPersonaFisicaModel extends Model
{

	protected $table            = 'FOLIOPERSONAFISICA';
	protected $allowedFields    = [
		'FOLIOID',
		'PERSONAFISICAID',
		'ANO',
		'CALIDADJURIDICAID',
		'RESERVARIDENTIDAD',
		'DENUNCIANTE',
		'VIVA',
		'TIPOIDENTIFICACIONID',
		'NUMEROIDENTIFICACION',
		'APODO',
		'NOMBRE',
		'PRIMERAPELLIDO',
		'SEGUNDOAPELLIDO',
		'NUMEROIDENTIDAD',
		'PAIS',
		'ESTADOORIGENID',
		'MUNICIPIOORIGENID',
		'FECHANACIMIENTO',
		'SEXO',
		'TELEFONO',
		'TELEFONO2',
		'CODIGOPAISTEL',
		'CODIGOPAISTEL2',
		'CORREO',
		'EDADCANTIDAD',
		'NACIONALIDADID',
		'ESTADOCIVILID',
		'FOTO',
		'FOTOGRAFIA_ACTUAL',
		'ESTADOJURIDICOIMPUTADOID',
		'DESAPARECIDA',
		'PERSONATIPOMUERTEID',
		'PERSONARELIGIONID',
		'TIPOVIVIENDAID',
		'LUGARFRECUENTA',
		'VESTUARIO',
		'AFECTOBEBIDA',
		'BEBIDAS',
		'AFECTODROGA',
		'DROGAS',
		'SOLICITANTEASESORIA',
		'INGRESOS',
		'PERSONAIDIOMAID',
		'TIEMPORESIDEANOS',
		'TIEMPORESIDEMESES',
		'TIEMPORESIDEDIAS',
		'ESCOLARIDADID',
		'OCUPACIONID',
		'OCUPACIONDESCR',
		'DESCRIPCION_FISICA',
		'FACEBOOK',
		'INSTAGRAM',
		'TWITTER',
		'LEER',
		'ESCRIBIR',
	];

	public function get_by_id($id)
	{
		$sql = 'select * from FOLIOPERSONAFISICA where PERSONAFISICAID =' . $id;
		$query =  $this->db->query($sql);

		return $query->getRow();
	}

	public function get_by_folio($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOID', 'PERSONAFISICAID', 'ANO', 'CALIDADJURIDICAID', 'NOMBRE', 'PRIMERAPELLIDO', 'SEGUNDOAPELLIDO', 'DENUNCIANTE', 'PERSONACALIDADJURIDICADESCR']);
		$builder->where('FOLIOID', $folio);
		$builder->where('ANO', $year);
		$builder->join('PERSONACALIDADJURIDICA', 'PERSONACALIDADJURIDICA.PERSONACALIDADJURIDICAID =' . $this->table . '.CALIDADJURIDICAID');
		$builder->orderBy('DENUNCIANTE ASC');
		$query = $builder->get();
		return $query->getResult('array');
	}
	public function get_by_persona_fisica_filtro($folio, $year, $idpersonafisica)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOID', 'PERSONAFISICAID', 'ANO', 'NOMBRE', 'PRIMERAPELLIDO', 'SEGUNDOAPELLIDO']);
		$builder->where('FOLIOID', $folio);
		$builder->where('ANO', $year);
		$builder->where('PERSONAFISICAID <>', $idpersonafisica);

		$query = $builder->get();
		return $query->getResult('array');
	}
	public function get_correos_persona($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['CORREO']);
		$builder->where('FOLIOID', $folio);
		$builder->where('ANO', $year);
		$builder->where('CORREO is NOT NULL');

		$query = $builder->get();
		return $query->getResult('array');
	}
	public function get_victimas($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOID', 'PERSONAFISICAID', 'ANO', 'NOMBRE', 'PRIMERAPELLIDO', 'SEGUNDOAPELLIDO']);
		$builder->where('FOLIOID', $folio);
		$builder->where('ANO', $year);
		$builder->where('(CALIDADJURIDICAID= 1 OR CALIDADJURIDICAID=6)');

		$query = $builder->get();
		return $query->getResult('array');
	}
	
	public function get_imputados($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOID', 'PERSONAFISICAID', 'ANO', 'NOMBRE', 'PRIMERAPELLIDO', 'SEGUNDOAPELLIDO']);
		$builder->where('FOLIOID', $folio);
		$builder->where('ANO', $year);
		$builder->where('CALIDADJURIDICAID', 2);

		$query = $builder->get();
		return $query->getResult('array');
	}

	public function get_by_personas($folio, $year, $idpersonafisica)
	{
		$builder = $this->db->table($this->table);
		$builder->select('*');
		$builder->where('FOLIOID', $folio);
		$builder->where('ANO', $year);
		$builder->where('PERSONAFISICAID', $idpersonafisica);

		$query = $builder->get();
		return $query->getResult('array');
	}
}
