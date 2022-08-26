<?php

namespace App\Models;

use CodeIgniter\Model;

class BarbillaInclinacionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'BARBILLAINCLINACION';
    protected $primaryKey       = 'BARBILLAINCLINACIONID';
    protected $allowedFields    = ['BARBILLAINCLINACIONID','BARBILLAINCLINACIONDESCR'];

    
}
