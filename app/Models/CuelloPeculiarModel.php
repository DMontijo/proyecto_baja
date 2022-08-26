<?php

namespace App\Models;

use CodeIgniter\Model;

class CuelloPeculiarModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'CUELLOPECULIAR';
    protected $primaryKey       = 'CUELLOPECULIARID';
    protected $allowedFields    = ['CUELLOPECULIARID','CUELLOPECULIARDESCR'];
}
