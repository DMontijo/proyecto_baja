<?php

namespace App\Models;

use CodeIgniter\Model;

class CejaFormaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'CEJAFORMA';
    protected $primaryKey       = 'CEJAFORMAID';
    protected $allowedFields    = ['CEJAFORMAID','CEJAFORMADESCR'];
}
