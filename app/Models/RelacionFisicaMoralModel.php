<?php

namespace App\Models;

use CodeIgniter\Model;

class RelacionFisicaMoralModel extends Model
{
    protected $table            = 'RELACIONFISICAMORAL';
	protected $allowedFields    = [
		'ID',
		'DENUNCIANTEID',
		'PERSONAMORALID',
		'RELACIONAR',
		'USUARIOIDRELACION',
		'RECHAZAR',
		'USUARIOIDRECHAZO',
		'PODERVOLUMEN',
		'PODERNONOTARIO',
		'PODERNOPODER',
		'PODERARCHIVO',
		'FECHAINICIOPODER',
		'FECHAFINPODER',
		'CARGO',
		'DESCRIPCIONCARGO',
		'FECHAREGISTRO',
		'FECHAACTUALIZACION'
	];
}
