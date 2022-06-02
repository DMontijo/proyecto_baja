<?php

namespace App\Models;

use CodeIgniter\Model;

class Datos_del_delitoModel extends Model

{       
    protected $DBGroup          = 'default';
	protected $table            = 'DATOS_DEL_DELITO';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
		'DELITO',
		'MUNICIPIO',
		'CALLE',
		'NO_EXTERIOR',
		'NO_INTERIOR',
		'COLONIA',
        'LUGAR',
		'CLASIFICACION',
		'FECHA',
		'HORA',
		'RESPONSABLE',
	];
    
}

