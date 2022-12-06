<?php

namespace App\Models;

use CodeIgniter\Model;

class BigoteFormaModel extends Model
{

    protected $table            = 'BIGOTEFORMA';
    protected $primaryKey       = 'BIGOTEFORMAID';
    protected $allowedFields    = ['BIGOTEFORMAID', 'BIGOTEFORMADESCR'];
}
