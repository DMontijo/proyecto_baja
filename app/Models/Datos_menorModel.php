<?php

namespace App\Models;

use CodeIgniter\Model;

class Datos_menorModel extends Model

{   

    protected $DBGroup          = 'default';
	protected $table            = 'DATOS_MENOR_EDAD';
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

