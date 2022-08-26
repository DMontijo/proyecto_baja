<?php

namespace App\Models;

use CodeIgniter\Model;

class CejaContexturaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'CEJACONTEXTURA';
    protected $primaryKey       = 'CONTEXTURAID';
    protected $allowedFields    = ['CONTEXTURAID','CONTEXTURADESCR'];
}
