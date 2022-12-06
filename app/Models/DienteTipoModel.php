<?php

namespace App\Models;

use CodeIgniter\Model;

class DienteTipoModel extends Model
{

    protected $table            = 'DIENTETIPO';
    protected $primaryKey       = 'DIENTETIPOID';
    protected $allowedFields    = ['DIENTETIPOID', 'DIENTETIPODESCR'];
}
