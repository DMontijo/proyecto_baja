<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIO';
	protected $allowedFields    = [
		'FOLIOID',
		'ANO',
		'EXPEDIENTEID',
		'DENUNCIANTEID',
		'AGENTEATENCIONID',
		'AGENTEFIRMAID',
		'STATUS',
		'NOTASAGENTE',
		'ESTADOID',
		'MUNICIPIOID',
		'HECHODELITO',
		'HECHOMEDIOCONOCIMIENTOID',
		'HECHOFECHA',
		'HECHOHORA',
		'HECHOLUGARID',
		'HECHOESTADOID',
		'HECHOMUNICIPIOID',
		'HECHOLOCALIDADID',
		'HECHODELEGACIONID',
		'HECHOZONA',
		'HECHOCOLONIAID',
		'HECHOCOLONIADESCR',
		'HECHOCALLE',
		'HECHONUMEROCASA',
		'HECHONUMEROCASAINT',
		'HECHOREFERENCIA',
		'HECHONARRACION',
		'TIPOEXPEDIENTEID',
		'HECHOCOORDENADAX',
		'HECHOCOORDENADAY',
		'LOCALIZACIONPERSONA',
		'DERECHOS',
		'FECHASALIDA'
	];
}
