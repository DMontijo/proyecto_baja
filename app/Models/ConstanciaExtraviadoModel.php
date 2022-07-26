<?php

namespace App\Models;

use CodeIgniter\Model;

class ConstanciaExtraviadoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'constancia_extravio';
    protected $primaryKey       = 'IDCERTIFICADOEXTRAVIADO';
    protected $allowedFields    = [
        'DENUNCIANTEID',
        'MUNICIPIOID',
        'ESTADOID',
        'EXTRAVIO',
        'DESCRIPCION_EXTRAVIO',
        'DOMICILIO',
        'HECHOLUGARID',
        'HECHOFECHA',
        'ANO',
        'HECHOHORA', 
        'NBOLETO',
        'NTALON',
        'NOMBRESORTEO',
        'SORTEOFECHA',
        'PERMISOGOBERNACION',
        'PERMISOGOBCOLABORADORES',
        'TIPODOCUMENTO',
        'NDOCUMENTO',
        'DUENONOMBREDOC',
        'DUENOAPELLIDOPDOC',
        'DUENOAPELLIDOMDOC',
        'SERIEVEHICULO',
        'NPLACA',
        'POSICIONPLACA',
        'DISTRIBUIDORVEHICULO',
        'MARCAID',
        'MODELOID',
        'ANIOVEHICULO',
        'STATUS'
    ];

}
