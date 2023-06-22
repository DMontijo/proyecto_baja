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
		'PODERVOLUMEN',
		'PODERNONOTARIO',
		'PODERNOPODER',
		'PODERARCHIVO',
		'FECHAINICIOPODER',
		'FECHAFINPODER',
		'FECHAREGISTRO',
	];
}
