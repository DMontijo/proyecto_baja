<?php

namespace App\Models;

use CodeIgniter\Model;

class FrentePeculiarModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'FRENTEPECULIAR';
    protected $primaryKey       = 'FRENTEPECULIARID';
    protected $allowedFields    = ['FRENTEPECULIARID','FRENTEPECULIARDESCR'];
}
