<?php

namespace App\Models;

use CodeIgniter\Model;

class LabioPeculiarModel extends Model
{

    protected $table            = 'LABIOPECULIAR';
    protected $primaryKey       = 'LABIOPECULIARID';
    protected $allowedFields    = ['LABIOPECULIARID', 'LABIOPECULIARDESCR'];
}
