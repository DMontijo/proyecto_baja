<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioPersonaMoralModel extends Model
{
    protected $table            = 'FOLIOPERSONAMORAL';
	protected $allowedFields    = [
		'FOLIOID',
		'ANO',
		'PERSONAMORALID',
		'NOTIFICACIONID',
		'CALIDADJURIDICAID',
		'DENOMINACION',
		'MARCACOMERCIAL',
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
        'PERSONAMORALGIROID',
		'PODERID',
		'FECHAFINPODER',
		'FECHAREGISTRO',
	];
	public function get_correos_notificacion($folio, $year){
		$builder = $this->db->table($this->table);
		$builder->select('PERSONAMORALNOTIFICACIONES.CORREO');
		$builder->join('PERSONAMORALNOTIFICACIONES', 'PERSONAMORALNOTIFICACIONES.NOTIFICACIONID = FOLIOPERSONAMORAL.NOTIFICACIONID AND PERSONAMORALNOTIFICACIONES.PERSONAMORALID = FOLIOPERSONAMORAL.PERSONAMORALID');
		$builder->where('FOLIOID', $folio);
		$builder->where('ANO', $year);
		$query = $builder->get();
		return $query->getResult('array');
	}
}
