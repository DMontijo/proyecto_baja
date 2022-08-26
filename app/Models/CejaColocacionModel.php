<?php

namespace App\Models;

use CodeIgniter\Model;

class CejaColocacionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'CEJACOLOCACION';
    protected $primaryKey       = 'CEJACOLOCACIONID';
    protected $allowedFields    = ['CEJACOLOCACIONID','CEJACOLOCACIONDESCR'];
}
