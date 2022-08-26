<?php

namespace App\Models;

use CodeIgniter\Model;

class HombroLongitudModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'HOMBROLONGITUD';
    protected $primaryKey       = 'HOMBROLONGITUDID';
    protected $allowedFields    = ['HOMBROLONGITUDID','HOMBROLONGITUDDESCR'];
}
