<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioObjetoModel extends Model
{
    protected $DBGroup          = 'default';
	protected $table            = 'FOLIOOBJETO';
	protected $allowedFields    = [
        'FOLIOID',
    'ANO',
    'OBJETOID',
    'SITUACION',
    'CLASIFICACIONID',
    'SUBCLASIFICACIONID',
    'MARCA',
    'NUMEROSERIE',
    'CANTIDAD',
    'VALOR',
    'TIPOMONEDAID',
    'DESCRIPCIONDETALLADA',
    'PERSONAFISICAIDPROPIETARIO',
    'PERSONAMORALIDPROPIETARIO',
    'FOTO',
    'PARTICIPAESTADO'];

}
