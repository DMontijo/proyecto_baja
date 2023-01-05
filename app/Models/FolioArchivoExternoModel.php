<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioArchivoExternoModel extends Model
{

    protected $table = 'FOLIOARCHIVOEXTERNO';

    protected $allowedFields = [
        'FOLIOID',
		'ANO',
		'FOLIOARCHIVOID',
		'ARCHIVODESCR',
		'ARCHIVO',
        'EXTENSION',
		'FECHAACTUALIZACION',
		'AUTOR',
		'OFICINAIDAUTOR',
		'CLASIFICACIONDOCTOID',
		'ESTADOACCESO',
		'PUBLICADO',
		'RUTAALMACENAMIENTOID',
		'STATUSALMACENID',
		'EXPORTAR'
    ];
}
