<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioPersonaFisicaModel extends Model
{
	protected $DBGroup          = 'default';
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
}
