<?php

namespace App\Models;

use CodeIgniter\Model;

class EstomagoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'DIENTETIPO';
    protected $primaryKey       = 'DIENTETIPOID';
    protected $allowedFields    = ['DIENTETIPOID','DIENTETIPODESCR'];
}
