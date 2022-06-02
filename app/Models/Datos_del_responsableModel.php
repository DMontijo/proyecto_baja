<?php

namespace App\Models;

use CodeIgniter\Model;

class Datos_del_responsableModel extends Model

{   

    protected $DBGroup          = 'default';
	protected $table            = 'DATOS_REPONSABLE';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
        'NOMBRE_IMPUTADO',
        'ALIAS',
        'PRIMER_APELLIDO',
        'SEGUNDO_APELLIDO',
        'MUNICIPIO_IMPUTADO',
        'CALLE',
        'NO_EXT_IMPUTADO',
        'NO_INT_IMPUTADO',
        'TELEFONO',
        'FECHA_NACIMIENTO',
        'SEXO',
        'ESCOLARIDAD',
        'DESCRIPCION_FISICA',
	];

}

