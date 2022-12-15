<?php

namespace App\Models;

use CodeIgniter\Model;

class OjoTamanoModel extends Model
{

    protected $table            = 'OJOTAMANO';
    protected $primaryKey       = 'OJOTAMANOID';
    protected $allowedFields    = ['OJOTAMANOID', 'OJOTAMANODESCR'];
}
