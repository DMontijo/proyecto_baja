<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadoExtranjeroModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ESTADOEXTRANJERO';
   
    protected $allowedFields    = ['ESTADOEXTRANJEROID','PAISID','ESTADOEXTRANJERODESCR'];

    
}
