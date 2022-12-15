<?php

namespace App\Models;

use CodeIgniter\Model;

class LabioLongitudModel extends Model
{

    protected $table            = 'LABIOLONGITUD';
    protected $primaryKey       = 'LABIOLONGITUDID';
    protected $allowedFields    = ['LABIOLONGITUDID', 'LABIOLONGITUDDESCR'];
}
