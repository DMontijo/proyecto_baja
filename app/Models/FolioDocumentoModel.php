<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioDocumentoModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIODOCUMENTO';
	protected $allowedFields    = [
		'FOLIOID',
		'FOLIODOCTOID',
		'DOCTODESCR',
		'DOCUMENTO',
		'FECHAIMPRESODEFINITIVA',
		'CLASIFICACIONDOCTOID',
		'AUTOR',
		'OFICINAIDAUTOR',
		'STATUSDOCUMENTOID',
		'PLANTILLAID',
		'CALIFICACION',
		'ESTADOACCESO',
		'EMPLEADORESPONSABLE',
		'EXPAREAIDRESPONSABLE',
		'EXPEMPIDRESPONSABLE',
		'PUBLICADO',
		'RUTAALMACENAMIENTOID',
		'STATUSALMACENID',
		'EXPORTAR',
	];
}
