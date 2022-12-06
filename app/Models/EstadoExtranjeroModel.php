<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadoExtranjeroModel extends Model
{

    protected $table            = 'ESTADOEXTRANJERO';

    protected $allowedFields    = ['ESTADOEXTRANJEROID', 'PAISID', 'ESTADOEXTRANJERODESCR'];
}
