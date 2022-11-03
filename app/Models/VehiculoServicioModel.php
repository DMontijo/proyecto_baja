<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiculoServicioModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'VEHICULOSERVICIO';
    protected $primaryKey       = 'VEHICULOSERVICIOID';
    protected $allowedFields    = ['VEHICULOSERVICIOID','VEHICULOSERVICIODESCR'];

}