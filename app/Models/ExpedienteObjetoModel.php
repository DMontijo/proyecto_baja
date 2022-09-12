<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpedienteObjetoModel extends Model
{
    protected $DBGroup          = 'default';
	protected $table            = 'EXPEDIENTEOBJETO';
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
