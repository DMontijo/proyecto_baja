<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoMonedaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'TIPOMONEDA';
    protected $primaryKey       = 'TIPOMONEDAID';
    protected $allowedFields    = ['TIPOMONEDAID','TIPOMONEDADESCR'];
}
