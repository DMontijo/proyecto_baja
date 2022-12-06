<?php

namespace App\Models;

use CodeIgniter\Model;

class CejaFormaModel extends Model
{

    protected $table            = 'CEJAFORMA';
    protected $primaryKey       = 'CEJAFORMAID';
    protected $allowedFields    = ['CEJAFORMAID', 'CEJAFORMADESCR'];
}
