<?php

namespace App\Models;

use CodeIgniter\Model;

class FrenteAlturaModel extends Model
{

    protected $table            = 'FRENTEALTURA';
    protected $primaryKey       = 'FRENTEALTURAID';
    protected $allowedFields    = ['FRENTEALTURAID', 'FRENTEALTURADESCR'];
}
