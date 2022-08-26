<?php

namespace App\Models;

use CodeIgniter\Model;

class LabioLongitudModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'LABIOLONGITUD';
    protected $primaryKey       = 'LABIOLONGITUDID';
    protected $allowedFields    = ['LABIOLONGITUDID','LABIOLONGITUDDESCR'];
}
