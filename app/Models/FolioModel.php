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
		'AGENTEASIGNADOID',
		'OFICINAASIGNADOID',
		'AREAASIGNADOID',
		'MUNICIPIOASIGNADOID',
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
		'INSTITUCIONREMISIONMUNICIPIOID',
		'INSTITUCIONREMISIONID'
	];

	public function filterDates($obj)
	{
		$strQuery = 'SELECT FOLIO.FOLIOID, FOLIO.ANO, FOLIO.EXPEDIENTEID, FOLIO.STATUS, FOLIO.TIPODENUNCIA, FOLIO.FECHASALIDA,DENUNCIANTES.NOMBRE AS "N_DENUNCIANTE", DENUNCIANTES.APELLIDO_PATERNO AS "APP_DENUNCIANTE", DENUNCIANTES.APELLIDO_MATERNO AS "APM_DENUNCIANTE", USUARIOS.NOMBRE AS "N_AGENT", 
		USUARIOS.APELLIDO_PATERNO AS "APP_AGENT", USUARIOS.APELLIDO_MATERNO AS "APM_AGENT", ESTADO.ESTADODESCR,MUNICIPIO.MUNICIPIODESCR,
		MUNICIPIOASIGNADO.MUNICIPIODESCR AS MUNICIPIOASIGNADO, TIPOEXPEDIENTE.TIPOEXPEDIENTEDESCR, EMPLEADOS.AREADESCR
		FROM FOLIO 
		LEFT JOIN USUARIOS ON USUARIOS.ID = FOLIO.AGENTEATENCIONID
		LEFT JOIN MUNICIPIO AS MUNICIPIOASIGNADO ON MUNICIPIOASIGNADO.MUNICIPIOID = FOLIO.MUNICIPIOASIGNADOID AND MUNICIPIOASIGNADO.ESTADOID = 2
		LEFT JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID
		LEFT JOIN TIPOEXPEDIENTE ON TIPOEXPEDIENTE.TIPOEXPEDIENTEID = FOLIO.TIPOEXPEDIENTEID
		LEFT JOIN EMPLEADOS ON EMPLEADOS.EMPLEADOID = FOLIO.AGENTEASIGNADOID AND EMPLEADOS.MUNICIPIOID = FOLIO.MUNICIPIOASIGNADOID
		LEFT JOIN ESTADO ON ESTADO.ESTADOID = FOLIO.ESTADOID
		LEFT JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = FOLIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = FOLIO.ESTADOID WHERE NOT FOLIO.STATUS = "ABIERTO" AND NOT FOLIO.STATUS = "EN PROCESO"';

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
		$strQuery = 'SELECT FOLIO.*,DENUNCIANTES.NOMBRE AS "N_DENUNCIANTE", DENUNCIANTES.APELLIDO_PATERNO AS "APP_DENUNCIANTE", DENUNCIANTES.APELLIDO_MATERNO AS "APM_DENUNCIANTE", ESTADO.ESTADODESCR,MUNICIPIO.MUNICIPIODESCR,
		USUARIOS.NOMBRE AS "N_AGENT", USUARIOS.APELLIDO_PATERNO AS "APP_AGENT", USUARIOS.APELLIDO_MATERNO AS "APM_AGENT",
		MUNICIPIOASIGNADO.MUNICIPIODESCR AS MUNICIPIOASIGNADO, TIPOEXPEDIENTE.TIPOEXPEDIENTECLAVE,EMPLEADOS.OFICINADESCR
		FROM FOLIO
		LEFT JOIN USUARIOS ON USUARIOS.ID = FOLIO.AGENTEATENCIONID 
		LEFT JOIN MUNICIPIO AS MUNICIPIOASIGNADO ON MUNICIPIOASIGNADO.MUNICIPIOID = FOLIO.MUNICIPIOASIGNADOID AND MUNICIPIOASIGNADO.ESTADOID = 2
		LEFT JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID
		LEFT JOIN TIPOEXPEDIENTE ON TIPOEXPEDIENTE.TIPOEXPEDIENTEID = FOLIO. TIPOEXPEDIENTEID
		LEFT JOIN EMPLEADOS ON EMPLEADOS.EMPLEADOID = FOLIO.AGENTEASIGNADOID AND EMPLEADOS.MUNICIPIOID = FOLIO.MUNICIPIOASIGNADOID
		LEFT JOIN ESTADO ON ESTADO.ESTADOID = FOLIO.ESTADOID
		LEFT JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = FOLIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = FOLIO.ESTADOID';

		$fechaInicio = isset($obj['fechaInicio']) ? $obj['fechaInicio'] : '';
		$fechaFin = isset($obj['fechaFin']) ? $obj['fechaFin'] : '';
		$horaInicio = isset($obj['horaInicio']) ? $obj['horaInicio'] : '';
		$horaFin = isset($obj['horaFin']) ? $obj['horaFin'] : '';

		if (isset($obj['fechaInicio'])) {
			unset($obj['fechaInicio']);
		}
		if (isset($obj['fechaFin'])) {
			unset($obj['fechaFin']);
		}
		if (isset($obj['horaInicio'])) {
			unset($obj['horaInicio']);
		}
		if (isset($obj['horaFin'])) {
			unset($obj['horaFin']);
		}

		$count = count($obj);

		if ($count > 0) {
			$strQuery = $strQuery . ' WHERE ';
		}

		foreach ($obj as $clave => $valor) {
			$count -= 1;
			if ($clave != 'fechaInicio' && $clave != 'fechaFin' && $clave != 'horaInicio' && $clave != 'horaFin') {
				$strQuery = $strQuery . 'FOLIO.' . $clave . ' = ' . '"' . $valor . '"';

				if ($count > 0) {
					$strQuery = $strQuery . ' AND ';
				}
			}
		}

		if (count($obj) > 0) {
			$strQuery = $strQuery . ' AND ';
		} else {
			$strQuery = $strQuery . ' WHERE ';
		}


		$strQuery =
			$strQuery . 'FOLIO.FECHAREGISTRO BETWEEN CAST("' .
			(isset($fechaInicio) ? date("Y-m-d", strtotime($fechaInicio)) : date("Y-m-d")) . ' ' .
			(isset($horaInicio) ? (date('H:i:s', strtotime($horaInicio))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
			(isset($fechaFin) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($fechaFin)) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($fechaFin))))) : date("Y-m-d")) . ' ' .
			(isset($horaFin) ? (date('H:i:s', strtotime($horaFin))) : '23:59:59') . '" AS DATETIME)';

		$result = $this->db->query($strQuery)->getResult();

		$dataView = (object)array();
		$dataView->result = $result;
		// $dataView->strQuery = $strQuery;
		return $dataView;
	}

	public function bandeja_salida($municipio)
	{
		$strQuery = 'SELECT FOLIO.FOLIOID, FOLIO.ANO, FOLIO.EXPEDIENTEID, FOLIO.MUNICIPIOASIGNADOID, FOLIO.STATUS, FOLIO.FECHASALIDA,FOLIO.FECHAREGISTRO, FOLIO.HECHODELITO, FOLIO.NOTASAGENTE, FOLIO.HECHOCALLE,ESTADO.ESTADODESCR, MUNICIPIO.MUNICIPIODESCR, MUNICIPIO.MUNICIPIOID, FOLIO.TIPODENUNCIA,GROUP_CONCAT(DELITOMODALIDAD.DELITOMODALIDADDESCR) AS "DELITOMODALIDADDESCR" FROM FOLIO 
		LEFT JOIN ESTADO ON ESTADO.ESTADOID = FOLIO.ESTADOID
		LEFT JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = FOLIO.MUNICIPIOASIGNADOID AND MUNICIPIO.ESTADOID = FOLIO.ESTADOID
		LEFT JOIN FOLIORELACIONFISFIS ON FOLIORELACIONFISFIS.FOLIOID = FOLIO.FOLIOID AND FOLIORELACIONFISFIS.ANO = FOLIO.ANO 
		LEFT JOIN DELITOMODALIDAD ON DELITOMODALIDAD.DELITOMODALIDADID = FOLIORELACIONFISFIS.DELITOMODALIDADID
		LEFT JOIN BANDEJARAC ON BANDEJARAC.EXPEDIENTEID = FOLIO.EXPEDIENTEID
		WHERE FOLIO.MUNICIPIOASIGNADOID = ' . $municipio . ' AND FOLIO.EXPEDIENTEID IS NOT NULL AND FOLIO.AGENTEASIGNADOID IS NULL AND BANDEJARAC.EXPEDIENTEID IS NULL
		GROUP BY EXPEDIENTEID;';

		$result = $this->db->query($strQuery)->getResult();

		$dataView = (object)array();
		$dataView->result = $result;
		return $dataView;
	}

	public function filterDatesRegistroDiario($obj)
	{
		if (isset($obj['STATUS'])) {
			if ($obj['STATUS'] == "CON") {

				$strQuery = 'SELECT FOLIO.FOLIOID, FOLIO.ANO, FOLIO.EXPEDIENTEID, FOLIO.STATUS, FOLIO.FECHASALIDA,FOLIO.FECHAREGISTRO, FOLIO.HECHODELITO, FOLIO.NOTASAGENTE,
				DENUNCIANTES.NOMBRE AS "N_DENUNCIANTE", DENUNCIANTES.APELLIDO_PATERNO AS "APP_DENUNCIANTE", DENUNCIANTES.APELLIDO_MATERNO AS "APM_DENUNCIANTE",DENUNCIANTES.TELEFONO AS "TELEFONODENUNCIANTE",DENUNCIANTES.CORREO AS "CORREODENUNCIANTE", 
				USUARIOS.NOMBRE AS "N_AGENT", USUARIOS.APELLIDO_PATERNO AS "APP_AGENT", USUARIOS.APELLIDO_MATERNO AS "APM_AGENT", 
				ESTADO.ESTADODESCR,MUNICIPIO.MUNICIPIODESCR, TIPOEXPEDIENTE.TIPOEXPEDIENTEDESCR,FOLIO.TIPODENUNCIA,  GROUP_CONCAT(DELITOMODALIDAD.DELITOMODALIDADDESCR) AS "DELITOMODALIDADDESCR"
				FROM FOLIO 
				INNER JOIN USUARIOS ON USUARIOS.ID = FOLIO.AGENTEATENCIONID
				INNER JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID
				INNER JOIN ESTADO ON ESTADO.ESTADOID = FOLIO.ESTADOID
				INNER JOIN TIPOEXPEDIENTE ON TIPOEXPEDIENTE.TIPOEXPEDIENTEID = FOLIO. TIPOEXPEDIENTEID
				INNER JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = FOLIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = FOLIO.ESTADOID
				INNER JOIN FOLIORELACIONFISFIS ON FOLIORELACIONFISFIS.FOLIOID = FOLIO.FOLIOID AND FOLIORELACIONFISFIS.ANO = FOLIO.ANO 
				INNER JOIN DELITOMODALIDAD ON DELITOMODALIDAD.DELITOMODALIDADID = FOLIORELACIONFISFIS.DELITOMODALIDADID 
				WHERE NOT FOLIO.EXPEDIENTEID IS NULL
				AND FOLIO.AGENTEATENCIONID= ' . session('ID');
				$strQuery =
					$strQuery . ' AND ' .
					'FOLIO.FECHASALIDA BETWEEN CAST("' .
					(isset($obj['fechaInicio']) ? date("Y-m-d", strtotime($obj['fechaInicio'])) : date("Y-m-d")) . ' ' .
					(isset($obj['horaInicio']) ? (date('H:i:s', strtotime($obj['horaInicio']))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
					(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin']))))) : date("Y-m-d")) . ' ' .
					(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '23:59:59') . '" AS DATETIME)';
				$strQuery = $strQuery . ' GROUP BY  FOLIO.FOLIOID';
			}
			if ($obj['STATUS'] == "SIN") {
				$strQuery = 'SELECT FOLIO.FOLIOID, FOLIO.ANO, FOLIO.EXPEDIENTEID, FOLIO.STATUS, FOLIO.FECHASALIDA,FOLIO.FECHAREGISTRO, FOLIO.HECHODELITO, FOLIO.NOTASAGENTE,
				DENUNCIANTES.NOMBRE AS "N_DENUNCIANTE", DENUNCIANTES.APELLIDO_PATERNO AS "APP_DENUNCIANTE", DENUNCIANTES.APELLIDO_MATERNO AS "APM_DENUNCIANTE",DENUNCIANTES.TELEFONO AS "TELEFONODENUNCIANTE",DENUNCIANTES.CORREO AS "CORREODENUNCIANTE", 
				USUARIOS.NOMBRE AS "N_AGENT", USUARIOS.APELLIDO_PATERNO AS "APP_AGENT", USUARIOS.APELLIDO_MATERNO AS "APM_AGENT", 
				ESTADO.ESTADODESCR,MUNICIPIO.MUNICIPIODESCR,FOLIO.TIPODENUNCIA, GROUP_CONCAT(DELITOMODALIDAD.DELITOMODALIDADDESCR) AS "DELITOMODALIDADDESCR"
				FROM FOLIO 
				LEFT JOIN USUARIOS ON USUARIOS.ID = FOLIO.AGENTEATENCIONID
				LEFT JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID
				LEFT JOIN ESTADO ON ESTADO.ESTADOID = FOLIO.ESTADOID
				LEFT JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = FOLIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = FOLIO.ESTADOID
				LEFT JOIN FOLIORELACIONFISFIS ON FOLIORELACIONFISFIS.FOLIOID = FOLIO.FOLIOID AND FOLIORELACIONFISFIS.ANO = FOLIO.ANO 
				LEFT JOIN DELITOMODALIDAD ON DELITOMODALIDAD.DELITOMODALIDADID = FOLIORELACIONFISFIS.DELITOMODALIDADID 
				WHERE FOLIO.AGENTEATENCIONID= ' . session('ID') . ' AND  FOLIO.EXPEDIENTEID IS NULL';

				$strQuery =
					$strQuery . ' AND ' .
					'FOLIO.FECHASALIDA BETWEEN CAST("' .
					(isset($obj['fechaInicio']) ? date("Y-m-d", strtotime($obj['fechaInicio'])) : date("Y-m-d")) . ' ' .
					(isset($obj['horaInicio']) ? (date('H:i:s', strtotime($obj['horaInicio']))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
					(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin']))))) : date("Y-m-d")) . ' ' .
					(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '23:59:59') . '" AS DATETIME)';
				$strQuery = $strQuery . ' GROUP BY  FOLIO.FOLIOID';
			}
			if ($obj['STATUS'] == "TODOS") {
				$strQuery = 'SELECT FOLIO.FOLIOID, FOLIO.ANO, FOLIO.EXPEDIENTEID, FOLIO.STATUS, FOLIO.FECHASALIDA,FOLIO.FECHAREGISTRO, FOLIO.HECHODELITO, FOLIO.NOTASAGENTE,
				DENUNCIANTES.NOMBRE AS "N_DENUNCIANTE", DENUNCIANTES.APELLIDO_PATERNO AS "APP_DENUNCIANTE", DENUNCIANTES.APELLIDO_MATERNO AS "APM_DENUNCIANTE",DENUNCIANTES.TELEFONO AS "TELEFONODENUNCIANTE",DENUNCIANTES.CORREO AS "CORREODENUNCIANTE", 
				USUARIOS.NOMBRE AS "N_AGENT", USUARIOS.APELLIDO_PATERNO AS "APP_AGENT", USUARIOS.APELLIDO_MATERNO AS "APM_AGENT", 
				ESTADO.ESTADODESCR,MUNICIPIO.MUNICIPIODESCR,TIPOEXPEDIENTE.TIPOEXPEDIENTEDESCR,FOLIO.TIPODENUNCIA,GROUP_CONCAT(DELITOMODALIDAD.DELITOMODALIDADDESCR) AS "DELITOMODALIDADDESCR"
				FROM FOLIO 
				INNER JOIN USUARIOS ON USUARIOS.ID = FOLIO.AGENTEATENCIONID
				LEFT JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID
				INNER JOIN ESTADO ON ESTADO.ESTADOID = FOLIO.ESTADOID
				INNER JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = FOLIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = FOLIO.ESTADOID
				LEFT JOIN TIPOEXPEDIENTE ON TIPOEXPEDIENTE.TIPOEXPEDIENTEID = FOLIO. TIPOEXPEDIENTEID
				LEFT JOIN FOLIORELACIONFISFIS ON FOLIORELACIONFISFIS.FOLIOID = FOLIO.FOLIOID AND FOLIORELACIONFISFIS.ANO = FOLIO.ANO 
				LEFT JOIN DELITOMODALIDAD ON DELITOMODALIDAD.DELITOMODALIDADID = FOLIORELACIONFISFIS.DELITOMODALIDADID 
				WHERE FOLIO.AGENTEATENCIONID= ' . session('ID');
				// $strQuery= $strQuery . ' AND '.'WHERE FOLIO.AGENTEATENCIONID= ' .$objusuario['agenteatencion'];

				$strQuery =
					$strQuery . ' AND ' .
					'FOLIO.FECHASALIDA BETWEEN CAST("' .
					(isset($obj['fechaInicio']) ? date("Y-m-d", strtotime($obj['fechaInicio'])) : date("Y-m-d")) . ' ' .
					(isset($obj['horaInicio']) ? (date('H:i:s', strtotime($obj['horaInicio']))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
					(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin']))))) : date("Y-m-d")) . ' ' .
					(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '23:59:59') . '" AS DATETIME)';
				$strQuery = $strQuery . ' GROUP BY  FOLIO.FOLIOID';
			}
		} else {
			$strQuery = 'SELECT FOLIO.FOLIOID, FOLIO.ANO, FOLIO.EXPEDIENTEID, FOLIO.STATUS, FOLIO.FECHASALIDA,FOLIO.FECHAREGISTRO, FOLIO.HECHODELITO, FOLIO.NOTASAGENTE,
			DENUNCIANTES.NOMBRE AS "N_DENUNCIANTE", DENUNCIANTES.APELLIDO_PATERNO AS "APP_DENUNCIANTE", DENUNCIANTES.APELLIDO_MATERNO AS "APM_DENUNCIANTE",DENUNCIANTES.TELEFONO AS "TELEFONODENUNCIANTE",DENUNCIANTES.CORREO AS "CORREODENUNCIANTE", 
			USUARIOS.NOMBRE AS "N_AGENT", USUARIOS.APELLIDO_PATERNO AS "APP_AGENT", USUARIOS.APELLIDO_MATERNO AS "APM_AGENT", 
			ESTADO.ESTADODESCR,MUNICIPIO.MUNICIPIODESCR, TIPOEXPEDIENTE.TIPOEXPEDIENTEDESCR , FOLIO.TIPODENUNCIA,  GROUP_CONCAT(DELITOMODALIDAD.DELITOMODALIDADDESCR) AS "DELITOMODALIDADDESCR"
			FROM FOLIO 
			INNER JOIN USUARIOS ON USUARIOS.ID = FOLIO.AGENTEATENCIONID
			LEFT JOIN DENUNCIANTES ON DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID
			LEFT JOIN TIPOEXPEDIENTE ON TIPOEXPEDIENTE.TIPOEXPEDIENTEID = FOLIO. TIPOEXPEDIENTEID
			INNER JOIN ESTADO ON ESTADO.ESTADOID = FOLIO.ESTADOID
			INNER JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = FOLIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = FOLIO.ESTADOID
			LEFT JOIN FOLIORELACIONFISFIS ON FOLIORELACIONFISFIS.FOLIOID = FOLIO.FOLIOID AND FOLIORELACIONFISFIS.ANO = FOLIO.ANO 
			LEFT JOIN DELITOMODALIDAD ON DELITOMODALIDAD.DELITOMODALIDADID = FOLIORELACIONFISFIS.DELITOMODALIDADID 
			WHERE FOLIO.AGENTEATENCIONID= ' . session('ID');

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
			$strQuery = $strQuery . ' GROUP BY  FOLIO.FOLIOID';
		}
		// var_dump($strQuery);
		// 	exit;
		$result = $this->db->query($strQuery)->getResult();

		$dataView = (object)array();
		$dataView->result = $result;
		return $dataView;

		// $dataView->strQuery = $strQuery;

	}

	public function filterDatesDocumentos($obj)
	{
		$strQuery = 'SELECT FOLIO.FOLIOID, FOLIO.ANO, FOLIO.EXPEDIENTEID, FOLIO.FECHAREGISTRO, FOLIO.FECHASALIDA,FOLIO.STATUS, FOLIO.ANO
			FROM FOLIO ';
		$count = 0;
		foreach ($obj as $clave => $valor) {
			if ($clave != 'fechaInicio' && $clave != 'fechaFin' && $clave != 'horaInicio' && $clave != 'horaFin') {
				if ($count == 0) {
					$strQuery = $strQuery . 'WHERE ';
					$strQuery = $strQuery . 'FOLIO.' . $clave . ' = ' . '"' . $valor . '"';
				} else {
					$strQuery = $strQuery . 'AND ';
					$strQuery = $strQuery . 'FOLIO.' . $clave . ' = ' . '"' . $valor . '"';
				}
				$count++;
			}
		}
		if ($count == 0) {
			$strQuery =
				$strQuery .
				'WHERE FOLIO.FECHASALIDA BETWEEN CAST("' .
				(isset($obj['fechaInicio']) ? date("Y-m-d", strtotime($obj['fechaInicio'])) : date("Y-m-d")) . ' ' .
				(isset($obj['horaInicio']) ? (date('H:i:s', strtotime($obj['horaInicio']))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
				(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin']))))) : date("Y-m-d")) . ' ' .
				(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '23:59:59') . '" AS DATETIME)';
		}
		$strQuery =
			$strQuery .
			'AND FOLIO.FECHASALIDA BETWEEN CAST("' .
			(isset($obj['fechaInicio']) ? date("Y-m-d", strtotime($obj['fechaInicio'])) : date("Y-m-d")) . ' ' .
			(isset($obj['horaInicio']) ? (date('H:i:s', strtotime($obj['horaInicio']))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
			(isset($obj['fechaFin']) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($obj['fechaFin'])) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($obj['fechaFin']))))) : date("Y-m-d")) . ' ' .
			(isset($obj['horaFin']) ? (date('H:i:s', strtotime($obj['horaFin']))) : '23:59:59') . '" AS DATETIME)';
		$result = $this->db->query($strQuery)->getResult();

		$dataView = (object)array();
		$dataView->result = $result;

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
	public function get_denunciante($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['*', 'FOLIO.ESTADOID AS FOLIOESTADO', 'FOLIO.MUNICIPIOID AS FOLIOMUNICIPIO', 'DENUNCIANTES.MUNICIPIOID AS DENUNCIANTEMUNICIPIO', 'DENUNCIANTES.ESTADOID AS DENUNCIANTEESTADO', 'DENUNCIANTES.NOMBRE', 'DENUNCIANTES.APELLIDO_PATERNO', 'DENUNCIANTES.APELLIDO_MATERNO']);
		$builder->where('FOLIOID', $folio);
		$builder->where('ANO', $year);
		$builder->join('DENUNCIANTES', 'DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID');
		$query = $builder->get();
		return $query->getRow();
	}
	public function get_folio_denunciante($denunciante)
	{

		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOID', 'EXPEDIENTEID', 'ANO', 'HECHODELITO']);
		$builder->where('FOLIO.DENUNCIANTEID', $denunciante);
		$builder->join('DENUNCIANTES', 'DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID');
		$builder->orderBy('FOLIO.FECHAREGISTRO ASC');
		$query = $builder->get();
		return $query->getResult('array');
	}
}
