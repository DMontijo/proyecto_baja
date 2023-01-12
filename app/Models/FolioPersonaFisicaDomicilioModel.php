<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioPersonaFisicaDomicilioModel extends Model
{

	protected $table            = 'FOLIOPERSONAFISDOMICILIO';
	protected $allowedFields    = [
		'FOLIOID',
		'PERSONAFISICAID',
		'DOMICILIOID',
		'ANO',
		'CP',
		'TIPODOMICILIO',
		'PAIS',
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
		'MANZANA',
		'LOTE',

	];
}
