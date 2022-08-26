<?php

namespace App\Models;

use CodeIgniter\Model;

class NarizBaseModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'NARIZBASE';
    protected $primaryKey       = 'NARIZBASEID';
    protected $allowedFields    = ['NARIZBASEID','NARIZBASEDESCR'];
}
