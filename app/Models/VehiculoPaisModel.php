<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiculoPaisModel extends Model
{

    protected $table            = 'VEHICULOPAIS';
    protected $primaryKey       = 'PAISID';
    protected $allowedFields    = ['PAISID', 'PAISDESCR'];
}
