<?php

namespace App\Models;

use CodeIgniter\Model;

class BigoteFormaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'BIGOTEFORMA';
    protected $primaryKey       = 'BIGOTEFORMAID';
    protected $allowedFields    = ['BIGOTEFORMAID','BIGOTEFORMADESCR'];

}
