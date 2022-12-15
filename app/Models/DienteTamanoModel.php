<?php

namespace App\Models;

use CodeIgniter\Model;

class DienteTamanoModel extends Model
{

    protected $table            = 'DIENTETAMANO';
    protected $primaryKey       = 'DIENTETAMANOID';
    protected $allowedFields    = ['DIENTETAMANOID', 'DIENTETAMANODESCR'];
}
