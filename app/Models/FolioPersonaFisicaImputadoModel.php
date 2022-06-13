<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioPersonaFisicaImputadoModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIOPERSONAFISIMP';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
		'FOLIOID',
		'PERSONAFISICAID',
		'DETENIDO',
		'ESTADOJURIDICOIMPUTADOID',
		'ETAPAIMPUTADOID',
		'INDIVIDUALIZADO',
	];
}
