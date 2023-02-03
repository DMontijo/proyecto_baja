<?php

namespace App\Models;

use CodeIgniter\Model;

class SesionesModel extends Model
{

	protected $table            = 'SESIONES';
	protected $allowedFields    = [
		'ID',
		'ID_USUARIO',
		'IP_USUARIO',
		'IP_PUBLICA',
		'AGENTE_HTTP',
		'ACTIVO',
		'AGENTE_SO',
		'AGENTE_MOBILE',
	];
	public function sesiones_abiertas(){
		$strQuery = 'SELECT SESIONES.ID_USUARIO, SESIONES.AGENTE_HTTP, SESIONES.AGENTE_SO, SESIONES.FECHAINICIO, USUARIOS.NOMBRE, USUARIOS.APELLIDO_PATERNO
		FROM SESIONES 
		LEFT JOIN USUARIOS ON USUARIOS.ID = SESIONES.ID_USUARIO
		WHERE SESIONES.ACTIVO = 1
		ORDER BY SESIONES.FECHAINICIO ASC';

		$result = $this->db->query($strQuery)->getResult();

		$dataView = (object)array();
		$dataView->result = $result;
		return $dataView;
	}
}
