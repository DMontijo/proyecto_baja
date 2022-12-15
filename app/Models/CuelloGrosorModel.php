<?php

namespace App\Models;

use CodeIgniter\Model;

class CuelloGrosorModel extends Model
{

    protected $table            = 'CUELLOGROSOR';
    protected $primaryKey       = 'CUELLOGROSORID';
    protected $allowedFields    = ['CUELLOGROSORID', 'CUELLOGROSORDESCR'];
}
