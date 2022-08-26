<?php

namespace App\Models;

use CodeIgniter\Model;

class HombroGrosorModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'HOMBROGROSOR';
    protected $primaryKey       = 'HOMBROGROSORID';
    protected $allowedFields    = ['HOMBROGROSORID','HOMBROGROSORDESCR'];
}
