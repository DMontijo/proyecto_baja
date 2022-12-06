<?php

namespace App\Models;

use CodeIgniter\Model;

class CabelloPeculiarModel extends Model
{

    protected $table            = 'CABELLOPECULIAR';
    protected $primaryKey       = 'CABELLOPECULIARID';
    protected $allowedFields    = ['CABELLOPECULIARID', 'CABELLOPECULIARDESCR'];
}
