<?php

namespace App\Models;

use CodeIgniter\Model;

class CaraFormaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'CARAFORMA';
    protected $primaryKey       = 'CARAFORMAID';
    protected $allowedFields    = ['CARAFORMAID','CARAFORMADESCR'];
}
