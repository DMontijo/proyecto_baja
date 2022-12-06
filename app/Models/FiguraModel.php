<?php

namespace App\Models;

use CodeIgniter\Model;

class FiguraModel extends Model
{

    protected $table            = 'FIGURA';
    protected $primaryKey       = 'FIGURAID';
    protected $allowedFields    = ['FIGURAID', 'FIGURADESCR'];
}
