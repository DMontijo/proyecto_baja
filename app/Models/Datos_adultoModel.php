<?php

namespace App\Models;

use CodeIgniter\Model;

class Datos_adultoModel extends Model

{   

    protected $DBGroup          = 'default';
	protected $table            = 'DATOS_ADULTO_ACOMPANANTE';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
        'NOMBRE',
        'APE_PATERNO',
        'APE_MATERNO',
        'PAIS',
        'ESTADO',
        'MUNICIPIO',
        'CALLE',
        'NO_EXTERIOR',
        'NO_INTERIOR',
        'CP',
        'FECHA_NACIMIENTO',
        'EDAD',
	];
}

