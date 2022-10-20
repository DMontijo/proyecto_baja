<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiculoStatusModel extends Model
{
    protected $table            = 'VEHICULOSTATUS';
    protected $primaryKey       = 'VEHICULOSTATUSID';
  
    protected $allowedFields    = ['VEHICULOSTATUSID','VEHICULOSTATUSDESCR'];

   
}
