<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
	protected $table = "USUARIOS";
	protected $primarykey = "ID";
	protected $allowedFields = [
		'ROLID',
		'ZONAID',
		'MUNICIPIOID',
		'OFICINAID',
		'MUNICIPIOSOFICINASID',
		'NOMBRE',
		'APELLIDO_PATERNO',
		'APELLIDO_MATERNO',
		'SEXO',
		'CORREO',
		'PASSWORD',
		'TOKENVIDEO',
	];
	function user_visualizador($user_id, $municipiosoficinasid){
		$municipiosoficinas = json_decode($municipiosoficinasid);
		$municipios = [];
		$oficinas = [];

		foreach ($municipiosoficinas as $item) {
			$municipios[] = $item->MUNICIPIOID;
			$oficinas[] = $item->OFICINAID;
		}
		$uniqueMunicipios = array_unique($municipios);
		$strQueryMunicipios ='SELECT GROUP_CONCAT(MUNICIPIO.MUNICIPIODESCR SEPARATOR \', \') AS municipios_concatenados
        FROM MUNICIPIO
		WHERE MUNICIPIO.MUNICIPIOID IN (' . implode(',', $uniqueMunicipios) . ')
		AND MUNICIPIO.ESTADOID = 2'
		;
		$strQueryOficinas = 'SELECT GROUP_CONCAT(OFICINA.OFICINADESCR SEPARATOR \', \') AS oficinas_concatenadas
        FROM OFICINA
		WHERE OFICINA.OFICINAID IN (' . implode(',', $oficinas) . ')
		AND OFICINA.MUNICIPIOID IN (' . implode(',', $uniqueMunicipios) . ')
		AND OFICINA.ESTADOID = 2';
		$resultMunicipios = $this->db->query($strQueryMunicipios)->getResult();
		$resultOficinas = $this->db->query($strQueryOficinas)->getResult();
		return [
			'municipios' => $resultMunicipios,
			'oficinas' => $resultOficinas
		];
	}
}
