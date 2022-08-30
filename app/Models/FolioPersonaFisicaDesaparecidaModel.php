<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioPersonaFisicaDesaparecidaModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIOPERSONAFISICADESAPARECIDA';
	protected $allowedFields    = [
		'FOLIOID',
		'PERSONAFISICAID',
		'ANO',
		'ESTATURA',
		'PESO',
		'COMPLEXION',
		'COLOR_TEZ',
		'SENAS',
		'IDENTIDAD',
		'COLOR_CABELLO',
		'TAM_CABELLO',
		'FORMA_CABELLO',
		'COLOR_OJOS',
		'FRENTE',
		'CEJA',
		'DISCAPACIDAD',
		'ORIGEN',
		'FECHADESAPARICION',
		'LUGARDESAPARICION',
		'VESTIMENTA',
		'PARENTESCO',
		'FOTOGRAFIA',
		'AUTORIZAMEDIOS',
	];
}
