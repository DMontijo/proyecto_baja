<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioObjetoModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIOOBJETO';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
		'FOLIOID',
		'OBJETOID',
		'SITUACION',
		'CLASIFICACIONID',
		'SUBCLASIFICACIONID',
		'MARCA',
		'NUMEROSERIE',
		'CANTIDAD',
		'VALOR',
		'TIPOMONEDAID',
		'DESCRIPCION',
		'DESCRIPCIONDETALLADA',
		'PERSONAFISICAIDPROPIETARIO',
		'PERSONAMORALIDPROPIETARIO',
		'FOTO',
		'PARTICIPAESTADO',
	];
}
