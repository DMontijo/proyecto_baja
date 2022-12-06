<?php

namespace App\Models;

use CodeIgniter\Model;

class PielColorModel extends Model
{

    protected $table            = 'PIELCOLOR';
    protected $primaryKey       = 'PIELCOLORID';
    protected $allowedFields    = ['PIELCOLORID', 'PIELCOLORDESCR'];
}
