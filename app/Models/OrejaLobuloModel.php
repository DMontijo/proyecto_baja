<?php

namespace App\Models;

use CodeIgniter\Model;

class OrejaLobuloModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'OREJALOBULO';
    protected $primaryKey       = 'OREJALOBULOID';
    protected $allowedFields    = ['OREJALOBULOID','OREJALOBULODESCR'];
}
