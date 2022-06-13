<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioRelacionFisicaFisicaModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIORELACIONFISFIS';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
		'FOLIOID',
		'PERSONAFISICAIDVICTIMA',
		'DELITOMODALIDADID',
		'PERSONAFISICAIDIMPUTADO',
		'GRADOPARTICIPACIONID',
		'TENTATIVA',
		'CONVIOLENCIA',
	];
}
