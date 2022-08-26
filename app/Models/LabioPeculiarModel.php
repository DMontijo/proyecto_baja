<?php

namespace App\Models;

use CodeIgniter\Model;

class LabioPeculiarModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'LABIOPECULIAR';
    protected $primaryKey       = 'LABIOPECULIARID';
    protected $allowedFields    = ['LABIOPECULIARID','LABIOPECULIARDESCR'];
}
