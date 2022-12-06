<?php

namespace App\Models;

use CodeIgniter\Model;

class NarizTipoModel extends Model
{

    protected $table            = 'NARIZTIPO';
    protected $primaryKey       = 'NARIZTIPOID';
    protected $allowedFields    = ['NARIZTIPOID', 'NARIZTIPODESCR'];
}
