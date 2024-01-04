<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaMoralNotificacionesModel extends Model
{
    protected $table            = 'PERSONAMORALNOTIFICACIONES';
    protected $allowedFields    = [
        'NOTIFICACIONID',
        'PERSONAMORALID',
        'ESTADOID',
        'MUNICIPIOID',
        'LOCALIDADID',
        'ZONA',
        'COLONIAID',
        'COLONIADESCR',
        'CALLE',
        'NUMERO',
        'NUMEROINTERIOR',
        'REFERENCIA',
        'TELEFONO',
        'TELEFONOADICIONAL',
        'CORREO',
        'FECHAREGISTRO',
        'FECHAACTUALIZACION'
    ];
}
