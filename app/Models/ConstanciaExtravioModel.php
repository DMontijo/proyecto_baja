<?php

namespace App\Models;

use CodeIgniter\Model;

class ConstanciaExtravioModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'CONSTANCIAEXTRAVIO';
	protected $allowedFields    = [
		'CONSTANCIAEXTRAVIOID',
		'ANO',
		'SOLICITANTEID',
		'MUNICIPIOID',
		'MUNICIPIOIDCITA',
		'ESTADOID',
		'EXTRAVIO',
		'DOMICILIO',
		'HECHOLUGARID',
		'HECHOFECHA',
		'PLACEHOLDER',
		'NBOLETO',
		'NTALON',
		'NOMBRESORTEO',
		'SORTEOFECHA',
		'PERMISOGOBERNACION',
		'PERMISOGOBCOLABORADORES',
		'TIPODOCUMENTO',
		'NDOCUMENTO',
		'DUENONOMBREDOC',
		'DUENOAPELLIDOPDOC',
		'DUENOAPELLIDOMDOC',
		'SERIEVEHICULO',
		'NPLACA',
		'POSICIONPLACA',
		'DISTRIBUIDORVEHICULO',
		'MARCA',
		'MODELO',
		'ANIOVEHICULO',
		'AGENTEID',
		'NUMEROIDENTIFICADOR',
		'RAZONSOCIALFIRMA',
		'RFCFIRMA',
		'NCERTIFICADOFIRMA',
		'FECHAFIRMA',
		'HORAFIRMA',
		'LUGARFIRMA',
		'CADENAFIRMADA',
		'FIRMAELECTRONICA',
		'PDF',
		'XML',
		'STATUS',
	];

	public function get_constancias_with_joins()
	{
		$query = $this
			->select('
				CONSTANCIAEXTRAVIOID,
				ANO,
				SOLICITANTEID,
				FECHAFIRMA,
				HORAFIRMA,
				LUGARFIRMA,
				EXTRAVIO,
				TIPODOCUMENTO,
				AGENTEID,
				STATUS,
				PDF,
				XML,
				RAZONSOCIALFIRMA
				')
			->where('STATUS','FIRMADO')
			->get();
		return $query->getResult('object');
	}
}
