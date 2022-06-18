<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioVehiculoModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIOVEHICULO';
	// protected $primaryKey       = 'ID';
	protected $allowedFields    = [
		'FOLIOID',
		'VEHICULOID',
		'SITUACION',
		'TIPOID',
		'MARCAID',
		'MARCADESCR',
		'MODELOID',
		'MODELODESCR',
		'ANO',
		'PLACAS',
		'NUMEROSERIE',
		'NUMEROMOTOR',
		'NUMEROCHASIS',
		'TRANSMISION',
		'TRACCION',
		'PRIMERCOLORID',
		'SEGUNDOCOLORID',
		'SENASPARTICULARES',
		'PERSONAFISICAIDPROPIETARIO',
		'PERSONAMORALIDPROPIETARIO',
		'FOTO',
		'DOCUMENTO',
		'PARTICIPAESTADO',
		'TIPOPLACA',
		'ESTADOIDPLACA',
		'ESTADOEXTRANJEROIDPLACA',
		'VEHICULODISTRIBUIDORID',
		'VEHICULOVERSIONID',
		'VEHICULOSERVICIOID',
		'VEHICULOSTATUSID',
		'PROVIENEPADRON',
		'SEGUROVIGENTE',
	];
}
