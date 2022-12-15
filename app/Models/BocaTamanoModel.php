<?php

namespace App\Models;

use CodeIgniter\Model;

class BocaTamanoModel extends Model
{

    protected $table            = 'BOCATAMANO';
    protected $primaryKey       = 'BOCATAMANOID';
    protected $allowedFields    = ['BOCATAMANOID', 'BOCATAMANODESCR'];
}
