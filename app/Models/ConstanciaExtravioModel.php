<?php

namespace App\Models;

use CodeIgniter\Model;

class ConstanciaExtravioModel extends Model
{

	protected $table            = 'CONSTANCIAEXTRAVIO';
	protected $allowedFields    = [
		'CONSTANCIAEXTRAVIOID',
		'ANO',
		'DENUNCIANTEID',
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
		'DUENOFECHANACIMIENTODOC',
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
				DENUNCIANTEID,
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
			->where('STATUS', 'FIRMADO')
			->get();
		return $query->getResult('object');
	}

	public function filterDates($obj)
	{

		if (isset($obj["STATUS"])) {

			if ($obj["STATUS"] == "ABIERTO") {
				$strQuery = 'SELECT CONSTANCIAEXTRAVIO.CONSTANCIAEXTRAVIOID, CONSTANCIAEXTRAVIO.ANO, CONSTANCIAEXTRAVIO.STATUS,CONSTANCIAEXTRAVIO.FECHAREGISTRO,CONSTANCIAEXTRAVIO.TIPODOCUMENTO, 
			CONSTANCIAEXTRAVIO.MUNICIPIOIDCITA,
		DENUNCIANTES.NOMBRE AS "N_SOLICITANTE", 
		DENUNCIANTES.APELLIDO_PATERNO AS "APP_SOLICITANTE", 
		DENUNCIANTES.APELLIDO_MATERNO AS "APM_SOLICITANTE", 
		ESTADO.ESTADODESCR,
		MUNICIPIO.MUNICIPIODESCR,
		MUNICIPIOCITA.MUNICIPIODESCR AS MUNICIPIODESCRCITA
		FROM CONSTANCIAEXTRAVIO 
		INNER JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = CONSTANCIAEXTRAVIO.DENUNCIANTEID
		INNER JOIN ESTADO ON ESTADO.ESTADOID = CONSTANCIAEXTRAVIO.ESTADOID
		INNER JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = CONSTANCIAEXTRAVIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = CONSTANCIAEXTRAVIO.ESTADOID
		LEFT JOIN MUNICIPIO  AS MUNICIPIOCITA ON MUNICIPIOCITA.MUNICIPIOID = CONSTANCIAEXTRAVIO.MUNICIPIOIDCITA  AND MUNICIPIOCITA.ESTADOID = CONSTANCIAEXTRAVIO.ESTADOID
		WHERE CONSTANCIAEXTRAVIO.STATUS = "ABIERTO"';


				foreach ($obj as $clave => $valor) {
					if ($clave != 'fechaInicio'  && $clave != 'horaInicio') {
						$strQuery = $strQuery . ' AND ';
						$strQuery = $strQuery . 'CONSTANCIAEXTRAVIO.' . $clave . ' = ' . '"' . $valor . '"';
					}
				}

				$strQuery =
					$strQuery . ' AND ' .
					'CONSTANCIAEXTRAVIO.FECHAREGISTRO BETWEEN CAST("' .
					(isset($obj['fechaInicio']) ? date("Y-m-d", strtotime($obj['fechaInicio'])) : date("Y-m-d")) . ' ' .
					(isset($obj['horaInicio']) ? (date('H:i:s', strtotime($obj['horaInicio']))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
					(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin']))))) : date("Y-m-d")) . ' ' .
					(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '23:59:59') . '" AS DATETIME)';
			}


			if ($obj["STATUS"] == "FIRMADO") {
				$strQuery = 'SELECT CONSTANCIAEXTRAVIO.CONSTANCIAEXTRAVIOID, CONSTANCIAEXTRAVIO.ANO, CONSTANCIAEXTRAVIO.STATUS, CONSTANCIAEXTRAVIO.FECHAFIRMA,CONSTANCIAEXTRAVIO.TIPODOCUMENTO,
		DENUNCIANTES.NOMBRE AS "N_SOLICITANTE", 
		CONSTANCIAEXTRAVIO.MUNICIPIOIDCITA,
		DENUNCIANTES.APELLIDO_PATERNO AS "APP_SOLICITANTE", 
		DENUNCIANTES.APELLIDO_MATERNO AS "APM_SOLICITANTE", 
		USUARIOS.NOMBRE AS "N_AGENT", 
		USUARIOS.APELLIDO_PATERNO AS "APP_AGENT", 
		USUARIOS.APELLIDO_MATERNO AS "APM_AGENT", 
		ESTADO.ESTADODESCR,
		MUNICIPIO.MUNICIPIODESCR,
		MUNICIPIOCITA.MUNICIPIODESCR AS MUNICIPIODESCRCITA
		FROM CONSTANCIAEXTRAVIO 
		INNER JOIN USUARIOS ON USUARIOS.ID = CONSTANCIAEXTRAVIO.AGENTEID
		INNER JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = CONSTANCIAEXTRAVIO.DENUNCIANTEID
		INNER JOIN ESTADO ON ESTADO.ESTADOID = CONSTANCIAEXTRAVIO.ESTADOID
		INNER JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = CONSTANCIAEXTRAVIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = CONSTANCIAEXTRAVIO.ESTADOID
		LEFT JOIN MUNICIPIO  AS MUNICIPIOCITA ON MUNICIPIOCITA.MUNICIPIOID = CONSTANCIAEXTRAVIO.MUNICIPIOIDCITA  AND MUNICIPIOCITA.ESTADOID = CONSTANCIAEXTRAVIO.ESTADOID';

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
					(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin']))))) : date("Y-m-d")) . ' ' .
					(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '23:59:59') . '" AS DATETIME)';
			}
		} else {
			$strQuery = 'SELECT CONSTANCIAEXTRAVIO.CONSTANCIAEXTRAVIOID, CONSTANCIAEXTRAVIO.ANO, CONSTANCIAEXTRAVIO.STATUS, CONSTANCIAEXTRAVIO.FECHAFIRMA,CONSTANCIAEXTRAVIO.TIPODOCUMENTO,			CONSTANCIAEXTRAVIO.MUNICIPIOIDCITA,

		DENUNCIANTES.NOMBRE AS "N_SOLICITANTE", 
		DENUNCIANTES.APELLIDO_PATERNO AS "APP_SOLICITANTE", 
		DENUNCIANTES.APELLIDO_MATERNO AS "APM_SOLICITANTE", 
		USUARIOS.NOMBRE AS "N_AGENT", 
		USUARIOS.APELLIDO_PATERNO AS "APP_AGENT", 
		USUARIOS.APELLIDO_MATERNO AS "APM_AGENT", 
		ESTADO.ESTADODESCR,
		MUNICIPIO.MUNICIPIODESCR,
		MUNICIPIOCITA.MUNICIPIODESCR AS MUNICIPIODESCRCITA
		FROM CONSTANCIAEXTRAVIO 
		INNER JOIN USUARIOS ON USUARIOS.ID = CONSTANCIAEXTRAVIO.AGENTEID
		INNER JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = CONSTANCIAEXTRAVIO.DENUNCIANTEID
		INNER JOIN ESTADO ON ESTADO.ESTADOID = CONSTANCIAEXTRAVIO.ESTADOID
		INNER JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = CONSTANCIAEXTRAVIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = CONSTANCIAEXTRAVIO.ESTADOID
		LEFT JOIN MUNICIPIO  AS MUNICIPIOCITA ON MUNICIPIOCITA.MUNICIPIOID = CONSTANCIAEXTRAVIO.MUNICIPIOIDCITA  AND MUNICIPIOCITA.ESTADOID = CONSTANCIAEXTRAVIO.ESTADOID';

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
				(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin']))))) : date("Y-m-d")) . ' ' .
				(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '23:59:59') . '" AS DATETIME)';
		}
		$result = $this->db->query($strQuery)->getResult();
		$dataView = (object)array();
		$dataView->result = $result;

		return $dataView;
	}


}