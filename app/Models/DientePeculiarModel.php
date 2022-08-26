<?php

namespace App\Models;

use CodeIgniter\Model;

class DientePeculiarModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'DIENTEPECULIAR';
    protected $primaryKey       = 'DIENTEPECULIARID';
    protected $allowedFields    = ['DIENTEPECULIARID','DIENTEPECULIARDESCR'];
}
