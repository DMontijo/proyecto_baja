<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioPersonaFisicaImputadoDelitoModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIOPERSONAFISIMPDELITO';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
		'FOLIOID',
		'PERSONAFISICAID',
		'DELITOMODALIDADID',
		'DELITOCARACTERISTICAID',
		'TENTATIVA',
	];
}
