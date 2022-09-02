<?php

namespace App\Models;

use CodeIgniter\Model;

class CabezaFormaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'CABEZAFORMA';
    protected $primaryKey       = 'CABEZAFORMAID';
    protected $allowedFields    = ['CABEZAFORMAID','CABEZAFORMADESCR'];

}