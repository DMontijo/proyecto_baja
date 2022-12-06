<?php

namespace App\Models;

use CodeIgniter\Model;

class CejaGrosorModel extends Model
{

    protected $table            = 'CEJAGROSOR';
    protected $primaryKey       = 'CEJAGROSORID';
    protected $allowedFields    = ['CEJAGROSORID', 'CEJAGROSORDESCR'];
}
