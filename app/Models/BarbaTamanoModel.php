<?php

namespace App\Models;

use CodeIgniter\Model;

class BarbaTamanoModel extends Model
{

    protected $table            = 'BARBATAMANO';
    protected $primaryKey       = 'BARBATAMANOID';

    protected $allowedFields    = ['BARBATAMANOID', 'BARBATAMANODESCR'];
}
