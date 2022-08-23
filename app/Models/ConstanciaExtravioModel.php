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
	public function filterDates($obj)
	{
		$strQuery = 'SELECT CONSTANCIAEXTRAVIO.CONSTANCIAEXTRAVIOID, CONSTANCIAEXTRAVIO.ANO, CONSTANCIAEXTRAVIO.STATUS, CONSTANCIAEXTRAVIO.FECHAFIRMA,
		SOLICITANTESCONSTANCIA.NOMBRE AS "N_SOLICITANTE", 
		SOLICITANTESCONSTANCIA.APELLIDO_PATERNO AS "APP_SOLICITANTE", 
		SOLICITANTESCONSTANCIA.APELLIDO_MATERNO AS "APM_SOLICITANTE", 
		USUARIOS.NOMBRE AS "N_AGENT", 
		USUARIOS.APELLIDO_PATERNO AS "APP_AGENT", 
		USUARIOS.APELLIDO_MATERNO AS "APM_AGENT", 
		ESTADO.ESTADODESCR,
		MUNICIPIO.MUNICIPIODESCR 
		FROM CONSTANCIAEXTRAVIO 
		INNER JOIN USUARIOS ON USUARIOS.ID = CONSTANCIAEXTRAVIO.AGENTEID
		INNER JOIN SOLICITANTESCONSTANCIA ON SOLICITANTESCONSTANCIA.SOLICITANTEID = CONSTANCIAEXTRAVIO.SOLICITANTEID
		INNER JOIN ESTADO ON ESTADO.ESTADOID = CONSTANCIAEXTRAVIO.ESTADOID
		INNER JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = CONSTANCIAEXTRAVIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = CONSTANCIAEXTRAVIO.ESTADOID';

		foreach ($obj as $clave => $valor) {
			if ($clave != 'fechaInicio' && $clave != 'fechaFin' && $clave != 'horaInicio' && $clave != 'horaFin') {
				$strQuery = $strQuery . ' AND ';
				$strQuery = $strQuery . 'CONSTANCIAEXTRAVIO.' . $clave . ' = ' . '"' . $valor . '"';
			}
		}

		$strQuery =
			$strQuery . ' AND ' .
			'CONSTANCIAEXTRAVIO.FECHAFIRMA BETWEEN CAST("' .
			(isset($obj['fechaInicio']) ? date("Y-m-d", strtotime($obj['fechaInicio'])) : date("Y-m-d")) . ' ' .
			(isset($obj['horaInicio']) ? (date('H:i:s', strtotime($obj['horaInicio']))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
			(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin'])) . '+1 day'))) : date("Y-m-d", strtotime('+1 day'))) . ' ' .
			(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '00:00:00') . '" AS DATETIME)';

		$result = $this->db->query($strQuery)->getResult();
		$dataView = (object)array();
		$dataView->result = $result;
		// $dataView->strQuery = $strQuery;
		return $dataView;
	}
}
