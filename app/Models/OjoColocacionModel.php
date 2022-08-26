<?php

namespace App\Models;

use CodeIgniter\Model;

class OjoColocacionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'OJOCOLOCACION';
    protected $primaryKey       = 'OJOCOLOCACIONID';
    protected $allowedFields    = ['OJOCOLOCACIONID','OJOCOLOCACIONDESCR'];
}
