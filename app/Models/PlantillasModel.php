<?php

namespace App\Models;

use CodeIgniter\Model;

class PlantillasModel extends Model
{

	protected $table            = 'PLANTILLAS';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
		'ID',
		'TITULO',
		'DESCRIPCION',
		'PLACEHOLDER',
		'TEXTO',
		'PLANTILLAJUSTICIAMEXICALIID',
		'CLASIFICACIONDOCTOMEXICALIID',
		'PLANTILLAJUSTICIATIJUANAID',
		'CLASIFICACIONDOCTOTIJUANAID',
		'PLANTILLAJUSTICIAENSENADAID',
		'CLASIFICACIONDOCTOENSENADAID',
		'AREAPERICIALMEXICALIID',
		'INTERVENCIONMEXICALIID',
		'AREAPERICIALTIJUANAID',
		'INTERVENCIONTIJUANAID',
		'AREAPERICIALENSENADAID',
		'INTERVENCIONENSENADAID',
		'ACTIVO'
	];

	public function get_tipos_orden()
	{
		$builder = $this->db->table($this->table);
		$builder->select(['ID', 'TITULO']);
		$builder->like('TITULO', 'ORDEN DE PROTECCION', 'after');
		$query = $builder->get();
		return $query->getResult('object');
	}
	public function filtro_ordenes_proteccion($bindParams)
	{
		$sql = 'SELECT DISTINCT FD.FOLIOID, FD.TIPODOC, FD.FECHAFIRMA, FD.ANO, MU.MUNICIPIODESCR, CONCAT(US.NOMBRE, " ", US.APELLIDO_PATERNO, " ",US.APELLIDO_MATERNO) AS NOMBRE_MP, FO.HECHODELITO, FO.EXPEDIENTEID, FP.LESIONES
		FROM FOLIODOC AS FD 
		LEFT JOIN FOLIO AS FO ON FO.FOLIOID = FD.FOLIOID
		LEFT JOIN MUNICIPIO AS MU ON MU.MUNICIPIOID = FD.MUNICIPIOID
		LEFT JOIN USUARIOS AS US ON US.ID = FD.AGENTE_REGISTRO
        LEFT JOIN FOLIOPREGUNTASDENUNCIA AS FP ON FP.FOLIOID = FO.FOLIOID
		WHERE FD.TIPODOC LIKE "%ORDEN DE PROTECCION%" AND MU.ESTADOID = 2';

		if (!empty($bindParams['MUNICIPIOID'])) $sql = $sql . ' AND MU.MUNICIPIOID = ' . $bindParams['MUNICIPIOID'];
		if (!empty($bindParams['AGENTEATENCIONID'])) $sql = $sql . ' AND US.ID = ' . $bindParams['AGENTEATENCIONID'];
		if (!empty($bindParams['GENERO'])) $sql = $sql . ' AND FPS.SEXO = ' . "'" . $bindParams['GENERO'] . "'";
		if (!empty($bindParams['TIPOORDEN'])) $sql = $sql . ' AND FD.TIPODOC LIKE ' . "'" . $bindParams['TIPOORDEN'] . "'";

		if (!empty($bindParams['fechaInicio']) && !empty($bindParams['fechaFin'])) $sql = $sql . ' AND FD.FECHAFIRMA BETWEEN ' . "'" . $bindParams['fechaInicio'] . "'" . ' AND ' . "'" . $bindParams['fechaFin'] . "'";
		if (!empty($bindParams['fechaInicio']) && empty($bindParams['fechaFin'])) $sql = $sql . ' AND FD.FECHAFIRMA BETWEEN ' . "'" . $bindParams['fechaInicio'] . "'" . ' AND ' . "'" . date("Y-m-d") . "'";
		if (empty($bindParams['fechaInicio']) && !empty($bindParams['fechaFin'])) $sql = $sql . ' AND FD.FECHAFIRMA BETWEEN ' . "'" . '2020-01-01' . "'" . ' AND ' . "'" . $bindParams['fechaFin'] . "'";

		if (!empty($bindParams['horaInicio']) && !empty($bindParams['horaFin'])) $sql = $sql . ' AND FD.HORAFIRMA BETWEEN ' . "'" . $bindParams['horaInicio'] . "'" . ' AND ' . "'" . $bindParams['horaFin'] . "'";
		if (!empty($bindParams['horaInicio']) && empty($bindParams['horaFin'])) $sql = $sql . ' AND FD.HORAFIRMA BETWEEN ' . "'" . $bindParams['horaInicio'] . "':00" . ' AND ' . "'" . '23:59:00' . "'";
		if (empty($bindParams['horaInicio']) && !empty($bindParams['horaFin'])) $sql = $sql . ' AND FD.HORAFIRMA BETWEEN ' . "'" . '00:00:00' . "'" . ' AND ' . "'" . $bindParams['horaFin'] . "':00";

		$query = $this->db->query($sql);

		return $query->getResult('object');
	}
}
