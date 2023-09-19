<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonasMoralesModel extends Model
{
	protected $table            = 'PERSONASMORALES';
	protected $allowedFields    = [
		'PERSONAMORALID',
		'RAZONSOCIAL',
		'MARCACOMERCIAL',
		'RFC',
		'PERSONAMORALGIROID',
		'ESTADOID',
		'MUNICIPIOID',
		'LOCALIDADID',
		'ZONA',
		'COLONIAID',
		'COLONIADESCR',
		'CALLE',
		'NUMERO',
		'NUMEROINTERIOR',
		'REFERENCIA',
		'TELEFONO',
		'CORREO',
		'CARGO',
		'DESCRIPCIONCARGO',
		'CAMBIO',
		'FECHAREGISTRO',
		'FECHAACTUALIZACION',
		'PODERID'
	];
	public function filterPersonasMorales($obj)
	{
		$strQuery = 'SELECT * FROM PERSONASMORALES
		LEFT JOIN ESTADO ON ESTADO.ESTADOID = PERSONASMORALES.ESTADOID
		LEFT JOIN MUNICIPIO ON MUNICIPIO.MUNICIPIOID = PERSONASMORALES.MUNICIPIOID AND MUNICIPIO.ESTADOID = PERSONASMORALES.ESTADOID
		';


		$fechaRegistro = isset($obj['fechaRegistro']) ? $obj['fechaRegistro'] : '';
		$fechaFin = isset($obj['fechaFin']) ? $obj['fechaFin'] : '';
		$horaInicio = isset($obj['horaInicio']) ? $obj['horaInicio'] : null;
		$horaFin = isset($obj['horaFin']) ? $obj['horaFin'] : null;

		if (isset($obj['fechaRegistro'])) {
			unset($obj['fechaRegistro']);
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
			if ($clave != 'fechaRegistro' && $clave != 'fechaFin') {
				$strQuery = $strQuery . 'PERSONASMORALES.' . $clave . ' = ' . '"' . $valor . '"';

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
		$strQuery = $strQuery . 'PERSONASMORALES.FECHAREGISTRO BETWEEN CAST("' .
			(isset($fechaRegistro) ? date("Y-m-d", strtotime($fechaRegistro)) : date("Y-m-d")) . ' ' .
			(isset($horaInicio) ? (date('H:i:s', strtotime($horaInicio))) : '00:00:00') . '" AS DATETIME)' . ' AND ' . 'CAST("' .
			(isset($fechaFin) ? (isset($obj['horaFin']) ? date("Y-m-d", strtotime($fechaFin)) : date("Y-m-d", strtotime(date("Y-m-d", strtotime($fechaFin))))) : date("Y-m-d")) . ' ' .
			(isset($horaFin) ? (date('H:i:s', strtotime($horaFin))) : '23:59:59') . '" AS DATETIME)';
		$resultAll = $this->db->query($strQuery)->getResult();
		$dataView = (object)array();
		$dataView->result = $resultAll;
		return $dataView;
	}
}
