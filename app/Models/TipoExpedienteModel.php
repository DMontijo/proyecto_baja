<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoExpedienteModel extends Model
{

	protected $table            = 'TIPOEXPEDIENTE';
	protected $allowedFields    = [
		'TIPOEXPEDIENTEID',
		'TIPOEXPEDIENTEDESCR',
		'TIPOEXPEDIENTECLAVE',
		'EDOJURIDICOIMPINICIALID',
		'PERMITECONCLUIR'
	];
}
