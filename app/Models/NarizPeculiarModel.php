<?php

namespace App\Models;

use CodeIgniter\Model;

class NarizPeculiarModel extends Model
{

    protected $table            = 'NARIZPECULIAR';
    protected $primaryKey       = 'NARIZPECULIARID';
    protected $allowedFields    = ['NARIZPECULIARID', 'NARIZPECULIARDESCR'];
}
