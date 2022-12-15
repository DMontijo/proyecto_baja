<?php

namespace App\Models;

use CodeIgniter\Model;

class CaraTezModel extends Model
{

    protected $table            = 'CARATEZ';
    protected $primaryKey       = 'CARATEZID';
    protected $allowedFields    = ['CARATEZID', 'CARATEZDESCR'];
}
