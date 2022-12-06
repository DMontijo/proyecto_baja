<?php

namespace App\Models;

use CodeIgniter\Model;

class OrejaFormaModel extends Model
{

    protected $table            = 'OREJAFORMA';
    protected $primaryKey       = 'OREJAFORMAID';
    protected $allowedFields    = ['OREJAFORMAID', 'OREJAFORMADESCR'];
}
