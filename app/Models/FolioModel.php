<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioModel extends Model
{

	protected $table            = 'FOLIO';
	protected $allowedFields    = [
		'FOLIOID',
		'ANO',
		'EXPEDIENTEID',
		'DENUNCIANTEID',
		'AGENTEATENCIONID',
		'AGENTEFIRMAID',
		'STATUS',
		'NOTASAGENTE',
		'TIPOEXPEDIENTEID',
		'TIPODENUNCIA',
		'ESTADOID',
		'MUNICIPIOID',
		'HECHODELITO',
		'HECHOMEDIOCONOCIMIENTOID',
		'HECHOFECHA',
		'HECHOHORA',
		'HECHOLUGARID',
		'HECHOESTADOID',
		'HECHOMUNICIPIOID',
		'HECHOLOCALIDADID',
		'HECHODELEGACIONID',
		'HECHOZONA',
		'HECHOCOLONIAID',
		'HECHOCOLONIADESCR',
		'HECHOCALLE',
		'HECHONUMEROCASA',
		'HECHONUMEROCASAINT',
		'HECHOREFERENCIA',
		'HECHONARRACION',
		'HECHOCOORDENADAX',
		'HECHOCOORDENADAY',
		'HECHOCLASIFICACIONLUGARID',
		'HECHOVIALIDADID',
		'LOCALIZACIONPERSONA',
		'LOCALIZACIONPERSONAMEDIOS',
		'DERECHOSOFENDIDO',
		'FECHASALIDA',
	];

	public function filterDates($obj)
	{
		$strQuery = 'SELECT FOLIO.FOLIOID, FOLIO.ANO, FOLIO.EXPEDIENTEID, FOLIO.STATUS, FOLIO.FECHASALIDA,DENUNCIANTES.NOMBRE AS "N_DENUNCIANTE", DENUNCIANTES.APELLIDO_PATERNO AS "APP_DENUNCIANTE", DENUNCIANTES.APELLIDO_MATERNO AS "APM_DENUNCIANTE", USUARIOS.NOMBRE AS "N_AGENT", USUARIOS.APELLIDO_PATERNO AS "APP_AGENT", USUARIOS.APELLIDO_MATERNO AS "APM_AGENT", ESTADO.ESTADODESCR,MUNICIPIO.MUNICIPIODESCR FROM FOLIO INNER JOIN USUARIOS ON USUARIOS.ID = FOLIO.AGENTEATENCIONID
		INNER JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID
		INNER JOIN ESTADO ON ESTADO.ESTADOID = FOLIO.ESTADOID
		INNER JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = FOLIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = FOLIO.ESTADOID WHERE NOT FOLIO.STATUS = "ABIERTO" AND NOT FOLIO.STATUS = "EN PROCESO"';

		foreach ($obj as $clave => $valor) {
			if ($clave != 'fechaInicio' && $clave != 'fechaFin' && $clave != 'horaInicio' && $clave != 'horaFin') {
				$strQuery = $strQuery . ' AND ';
				$strQuery = $strQuery . 'FOLIO.' . $clave . ' = ' . '"' . $valor . '"';
			}
		}


		$strQuery =
			$strQuery . ' AND ' .
			'FOLIO.FECHASALIDA BETWEEN CAST("' .
			(isset($obj['fechaInicio']) ? date("Y-m-d", strtotime($obj['fechaInicio'])) : date("Y-m-d")) . ' ' .
			(isset($obj['horaInicio']) ? (date('H:i:s', strtotime($obj['horaInicio']))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
			(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin']))))) : date("Y-m-d")) . ' ' .
			(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '23:59:59') . '" AS DATETIME)';


		$result = $this->db->query($strQuery)->getResult();

		$dataView = (object)array();
		$dataView->result = $result;
		// $dataView->strQuery = $strQuery;
		return $dataView;
	}

	public function filterAllDates($obj)
	{
		$strQuery = 'SELECT FOLIO.*,DENUNCIANTES.NOMBRE AS "N_DENUNCIANTE", DENUNCIANTES.APELLIDO_PATERNO AS "APP_DENUNCIANTE", DENUNCIANTES.APELLIDO_MATERNO AS "APM_DENUNCIANTE", ESTADO.ESTADODESCR,MUNICIPIO.MUNICIPIODESCR FROM FOLIO
		INNER JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID
		INNER JOIN ESTADO ON ESTADO.ESTADOID = FOLIO.ESTADOID
		INNER JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = FOLIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = FOLIO.ESTADOID';

		foreach ($obj as $clave => $valor) {
			if ($clave != 'fechaInicio' && $clave != 'fechaFin' && $clave != 'horaInicio' && $clave != 'horaFin') {
				$strQuery = $strQuery . ' AND ';
				$strQuery = $strQuery . 'FOLIO.' . $clave . ' = ' . '"' . $valor . '"';
			}
		}

		$strQuery =
			$strQuery . ' AND ' .
			'FOLIO.FECHAREGISTRO BETWEEN CAST("' .
			(isset($obj['fechaInicio']) ? date("Y-m-d", strtotime($obj['fechaInicio'])) : date("Y-m-d")) . ' ' .
			(isset($obj['horaInicio']) ? (date('H:i:s', strtotime($obj['horaInicio']))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
			(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin']))))) : date("Y-m-d")) . ' ' .
			(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '23:59:59') . '" AS DATETIME)';

		$result = $this->db->query($strQuery)->getResult();

		$dataView = (object)array();
		$dataView->result = $result;
		// $dataView->strQuery = $strQuery;
		return $dataView;
	}

	public function filterDatesRegistroDiario($obj)
	{
		if (isset($obj['STATUS'])) {
			if ($obj['STATUS'] == "CON") {

				$strQuery = 'SELECT FOLIO.FOLIOID, FOLIO.ANO, FOLIO.EXPEDIENTEID, FOLIO.STATUS, FOLIO.FECHASALIDA,FOLIO.FECHAREGISTRO, FOLIO.HECHODELITO, FOLIO.NOTASAGENTE,
				DENUNCIANTES.NOMBRE AS "N_DENUNCIANTE", DENUNCIANTES.APELLIDO_PATERNO AS "APP_DENUNCIANTE", DENUNCIANTES.APELLIDO_MATERNO AS "APM_DENUNCIANTE",DENUNCIANTES.TELEFONO AS "TELEFONODENUNCIANTE",DENUNCIANTES.CORREO AS "CORREODENUNCIANTE", 
		USUARIOS.NOMBRE AS "N_AGENT", USUARIOS.APELLIDO_PATERNO AS "APP_AGENT", USUARIOS.APELLIDO_MATERNO AS "APM_AGENT", 
		ESTADO.ESTADODESCR,MUNICIPIO.MUNICIPIODESCR, TIPOEXPEDIENTE.TIPOEXPEDIENTEDESCR 
		FROM FOLIO 
		INNER JOIN USUARIOS ON USUARIOS.ID = FOLIO.AGENTEATENCIONID
		INNER JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID
		INNER JOIN ESTADO ON ESTADO.ESTADOID = FOLIO.ESTADOID
		INNER JOIN TIPOEXPEDIENTE ON TIPOEXPEDIENTE.TIPOEXPEDIENTEID = FOLIO. TIPOEXPEDIENTEID
		INNER JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = FOLIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = FOLIO.ESTADOID
		WHERE NOT FOLIO.EXPEDIENTEID IS NULL
		AND FOLIO.AGENTEATENCIONID= ' . session('ID');
				$strQuery =
					$strQuery . ' AND ' .
					'FOLIO.FECHASALIDA BETWEEN CAST("' .
					(isset($obj['fechaInicio']) ? date("Y-m-d", strtotime($obj['fechaInicio'])) : date("Y-m-d")) . ' ' .
					(isset($obj['horaInicio']) ? (date('H:i:s', strtotime($obj['horaInicio']))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
					(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin']))))) : date("Y-m-d")) . ' ' .
					(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '23:59:59') . '" AS DATETIME)';
			}
			if ($obj['STATUS'] == "SIN") {
				$strQuery = 'SELECT FOLIO.FOLIOID, FOLIO.ANO, FOLIO.EXPEDIENTEID, FOLIO.STATUS, FOLIO.FECHASALIDA,FOLIO.FECHAREGISTRO, FOLIO.HECHODELITO, FOLIO.NOTASAGENTE,
				DENUNCIANTES.NOMBRE AS "N_DENUNCIANTE", DENUNCIANTES.APELLIDO_PATERNO AS "APP_DENUNCIANTE", DENUNCIANTES.APELLIDO_MATERNO AS "APM_DENUNCIANTE",DENUNCIANTES.TELEFONO AS "TELEFONODENUNCIANTE",DENUNCIANTES.CORREO AS "CORREODENUNCIANTE", 
		USUARIOS.NOMBRE AS "N_AGENT", USUARIOS.APELLIDO_PATERNO AS "APP_AGENT", USUARIOS.APELLIDO_MATERNO AS "APM_AGENT", 
		ESTADO.ESTADODESCR,MUNICIPIO.MUNICIPIODESCR
		FROM FOLIO 
		INNER JOIN USUARIOS ON USUARIOS.ID = FOLIO.AGENTEATENCIONID
		INNER JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID
		INNER JOIN ESTADO ON ESTADO.ESTADOID = FOLIO.ESTADOID
		INNER JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = FOLIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = FOLIO.ESTADOID
		WHERE FOLIO.AGENTEATENCIONID= ' . session('ID') . ' AND  FOLIO.EXPEDIENTEID IS NULL';
				// $strQuery= $strQuery . ' AND '.'WHERE FOLIO.AGENTEATENCIONID= ' .$objusuario['agenteatencion'];

				// foreach ($obj as $clave => $valor) {
				// 	if ($clave != 'fechaInicio' && $clave != 'fechaFin' && $clave != 'horaInicio' && $clave != 'horaFin') {
				// 	}
				// }


				$strQuery =
					$strQuery . ' AND ' .
					'FOLIO.FECHASALIDA BETWEEN CAST("' .
					(isset($obj['fechaInicio']) ? date("Y-m-d", strtotime($obj['fechaInicio'])) : date("Y-m-d")) . ' ' .
					(isset($obj['horaInicio']) ? (date('H:i:s', strtotime($obj['horaInicio']))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
					(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin']))))) : date("Y-m-d")) . ' ' .
					(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '23:59:59') . '" AS DATETIME)';
			}
			if ($obj['STATUS'] == "TODOS") {
				$strQuery = 'SELECT FOLIO.FOLIOID, FOLIO.ANO, FOLIO.EXPEDIENTEID, FOLIO.STATUS, FOLIO.FECHASALIDA,FOLIO.FECHAREGISTRO, FOLIO.HECHODELITO, FOLIO.NOTASAGENTE,
				DENUNCIANTES.NOMBRE AS "N_DENUNCIANTE", DENUNCIANTES.APELLIDO_PATERNO AS "APP_DENUNCIANTE", DENUNCIANTES.APELLIDO_MATERNO AS "APM_DENUNCIANTE",DENUNCIANTES.TELEFONO AS "TELEFONODENUNCIANTE",DENUNCIANTES.CORREO AS "CORREODENUNCIANTE", 
		USUARIOS.NOMBRE AS "N_AGENT", USUARIOS.APELLIDO_PATERNO AS "APP_AGENT", USUARIOS.APELLIDO_MATERNO AS "APM_AGENT", 
		ESTADO.ESTADODESCR,MUNICIPIO.MUNICIPIODESCR,TIPOEXPEDIENTE.TIPOEXPEDIENTEDESCR 
		FROM FOLIO 
		INNER JOIN USUARIOS ON USUARIOS.ID = FOLIO.AGENTEATENCIONID
		INNER JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID
		INNER JOIN ESTADO ON ESTADO.ESTADOID = FOLIO.ESTADOID
		INNER JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = FOLIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = FOLIO.ESTADOID
		LEFT JOIN TIPOEXPEDIENTE ON TIPOEXPEDIENTE.TIPOEXPEDIENTEID = FOLIO. TIPOEXPEDIENTEID

		WHERE FOLIO.AGENTEATENCIONID= ' . session('ID');
				// $strQuery= $strQuery . ' AND '.'WHERE FOLIO.AGENTEATENCIONID= ' .$objusuario['agenteatencion'];


				$strQuery =
					$strQuery . ' AND ' .
					'FOLIO.FECHASALIDA BETWEEN CAST("' .
					(isset($obj['fechaInicio']) ? date("Y-m-d", strtotime($obj['fechaInicio'])) : date("Y-m-d")) . ' ' .
					(isset($obj['horaInicio']) ? (date('H:i:s', strtotime($obj['horaInicio']))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
					(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin']))))) : date("Y-m-d")) . ' ' .
					(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '23:59:59') . '" AS DATETIME)';
			}
		} else {
			$strQuery = 'SELECT FOLIO.FOLIOID, FOLIO.ANO, FOLIO.EXPEDIENTEID, FOLIO.STATUS, FOLIO.FECHASALIDA,FOLIO.FECHAREGISTRO, FOLIO.HECHODELITO, FOLIO.NOTASAGENTE,
			DENUNCIANTES.NOMBRE AS "N_DENUNCIANTE", DENUNCIANTES.APELLIDO_PATERNO AS "APP_DENUNCIANTE", DENUNCIANTES.APELLIDO_MATERNO AS "APM_DENUNCIANTE",DENUNCIANTES.TELEFONO AS "TELEFONODENUNCIANTE",DENUNCIANTES.CORREO AS "CORREODENUNCIANTE", 
		USUARIOS.NOMBRE AS "N_AGENT", USUARIOS.APELLIDO_PATERNO AS "APP_AGENT", USUARIOS.APELLIDO_MATERNO AS "APM_AGENT", 
		ESTADO.ESTADODESCR,MUNICIPIO.MUNICIPIODESCR, TIPOEXPEDIENTE.TIPOEXPEDIENTEDESCR 
		FROM FOLIO 
		INNER JOIN USUARIOS ON USUARIOS.ID = FOLIO.AGENTEATENCIONID
		INNER JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID
		LEFT JOIN TIPOEXPEDIENTE ON TIPOEXPEDIENTE.TIPOEXPEDIENTEID = FOLIO. TIPOEXPEDIENTEID
		INNER JOIN ESTADO ON ESTADO.ESTADOID = FOLIO.ESTADOID
		INNER JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = FOLIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = FOLIO.ESTADOID
		WHERE FOLIO.AGENTEATENCIONID= ' . session('ID');
			// $strQuery= $strQuery . ' AND '.'WHERE FOLIO.AGENTEATENCIONID= ' .$objusuario['agenteatencion'];

			foreach ($obj as $clave => $valor) {
				if ($clave != 'fechaInicio' && $clave != 'fechaFin' && $clave != 'horaInicio' && $clave != 'horaFin') {
					$strQuery = $strQuery . ' AND ';
					$strQuery = $strQuery . 'FOLIO.' . $clave . ' = ' . '"' . $valor . '"';
				}
			}


			$strQuery =
				$strQuery . ' AND ' .
				'FOLIO.FECHASALIDA BETWEEN CAST("' .
				(isset($obj['fechaInicio']) ? date("Y-m-d", strtotime($obj['fechaInicio'])) : date("Y-m-d")) . ' ' .
				(isset($obj['horaInicio']) ? (date('H:i:s', strtotime($obj['horaInicio']))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
				(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin']))))) : date("Y-m-d")) . ' ' .
				(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '23:59:59') . '" AS DATETIME)';
		}

		$result = $this->db->query($strQuery)->getResult();

		$dataView = (object)array();
		$dataView->result = $result;

		// var_dump($dataView);
		// exit;
		// $dataView->strQuery = $strQuery;
		return $dataView;
	}

	public function get_folio_expediente()
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOID', 'EXPEDIENTEID', 'FECHAREGISTRO', 'STATUS', 'ANO']);
		$builder->where('STATUS', 'EXPEDIENTE');
		$builder->orderBy('EXPEDIENTEID ASC');
		$query = $builder->get();
		return $query->getResult('array');
	}
}
