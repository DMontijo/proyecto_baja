<?php

namespace App\Models;

use CodeIgniter\Model;

class CejaTamanoModel extends Model
{

    protected $table            = 'CEJATAMANO';
    protected $primaryKey       = 'CEJATAMANOID';
    protected $allowedFields    = ['CEJATAMANOID', 'CEJATAMANODESCR'];
}
