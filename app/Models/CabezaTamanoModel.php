<?php

namespace App\Models;

use CodeIgniter\Model;

class CabezaTamanoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'CABEZATAMANO';
    protected $primaryKey       = 'CABEZATAMANOID';
    protected $allowedFields    = ['CABEZATAMANOID','CABEZATAMANODESCR'];
}
