<?php

namespace App\Models;

use CodeIgniter\Model;

class CaraTamanoModel extends Model
{

    protected $table            = 'CARATAMANO';
    protected $primaryKey       = 'CARATAMANOID';
    protected $allowedFields    = ['CARATAMANOID', 'CARATAMANODESCR'];
}
