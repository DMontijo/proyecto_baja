<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioDocModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'FOLIODOC';

    protected $allowedFields    = [
        'FOLIODOCID',
        'FOLIOID',
        'ANO',
        'DENUNCIANTEID',
        'ESTADOID',
        'MUNICIPIOID',
        'NUMEROEXPEDIENTE',
        'VICTIMANOMBRE',
        'VICTIMAEDAD',
        'VICTIMATELEFONO',
        'VICTIMADOMICILIO',
        'RELACIONDELITO',
        'IMPUTADONOMBRE',
        'IMPUTADOEDAD',
        'HECHO',
        'NUMDELITO',
        'ZONASEJAP',
        'TIPODOC',
        'PLACEHOLDER',
        'OFICINAID',
        'AGENTEID',
        'NUMEROIDENTIFICADOR',
        'RAZONSOCIALFIRMA',
        'RFCFIRMA',
        'NCERTIFICADOFIRMA',
        'FECHAFIRMA',
        'HORAFIRMA',
        'LUGARFIRMA',
        'CADENAFIRMADA',
        'FIRMAELECTRONICA',
        'PDF',
        'STATUS',
    ];
}
