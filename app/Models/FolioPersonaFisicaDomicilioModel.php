<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioPersonaFisicaDomicilioModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIOPERSONAFISDOMICILIO';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
		'FOLIOID',
		'PERSONAFISICAID',
		'DOMICILIOID',
		'CP',
		'TIPODOMICILIO',
		'ESTADOID',
		'MUNICIPIOID',
		'LOCALIDADID',
		'DELEGACIONID',
		'ZONA',
		'COLONIAID',
		'COLONIADESCR',
		'CALLE',
		'NUMEROCASA',
		'NUMEROINTERIOR',
		'REFERENCIA',
	];
}
