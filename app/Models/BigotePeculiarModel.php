<?php

namespace App\Models;

use CodeIgniter\Model;

class BigotePeculiarModel extends Model
{

    protected $table            = 'BIGOTEPECULIAR';
    protected $primaryKey       = 'BIGOTEPECULIARID';
    protected $allowedFields    = ['BIGOTEPECULIARID', 'BIGOTEPECULIARDESCR'];
}
