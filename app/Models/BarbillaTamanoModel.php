<?php

namespace App\Models;

use CodeIgniter\Model;

class BarbillaTamanoModel extends Model
{

    protected $table            = 'BARBILLATAMANO';
    protected $primaryKey       = 'BARBILLATAMANOID';
    protected $allowedFields    = ['BARBILLATAMANOID', 'BARBILLATAMANODESCR'];
}
