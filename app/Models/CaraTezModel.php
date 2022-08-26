<?php

namespace App\Models;

use CodeIgniter\Model;

class CaraTezModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'CARATEZ';
    protected $primaryKey       = 'CARATEZID';
    protected $allowedFields    = ['CARATEZID','CARATEZDESCR'];
}
