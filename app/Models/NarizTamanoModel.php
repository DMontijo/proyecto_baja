<?php

namespace App\Models;

use CodeIgniter\Model;

class NarizTamanoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'NARIZTAMANO';
    protected $primaryKey       = 'NARIZTAMANOID';
    protected $allowedFields    = ['NARIZTAMANOID','NARIZTAMANODESCR'];
}
