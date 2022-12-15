<?php

namespace App\Models;

use CodeIgniter\Model;

class EstomagoModel extends Model
{

    protected $table            = 'ESTOMAGO';
    protected $primaryKey       = 'ESTOMAGOID';
    protected $allowedFields    = ['ESTOMAGOID', 'ESTOMAGODESCR'];
}
