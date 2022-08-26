<?php

namespace App\Models;

use CodeIgniter\Model;

class BocaPeculiarModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'BOCAPECULIAR';
    protected $primaryKey       = 'BOCAPECULIARID';
    protected $allowedFields    = ['BOCAPECULIARID','BOCAPECULIARDESCR'];


}
