<?php

namespace App\Models;

use CodeIgniter\Model;

class Datos_desaparecidoModel extends Model

{   

    protected $DBGroup          = 'default';
	protected $table            = 'DATOS_PERSONA_DESAPARECIDA';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
        'NOMBRE',
        'APE_PATERNO',
        'APE_MATERNO',
        'ESTATURA',
        'FECHA_NACIMIENTO',
        'EDAD',
        'PESO',
        'COMPLEXION',
        'COLOR_TEZ',
        'SEXO',
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
        'DIA_DESAPARICION',
        'LUGAR_DESAPARICION',
        'VESTIMENTA',
        'PARENTESCO',
        'FOTOGRAFIA',
        'AUTORIZA_FOTO',
	];
}
