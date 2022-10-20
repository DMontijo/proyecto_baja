<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiculoSituacionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'VEHICULOSITUACION';
    protected $primaryKey       = 'VEHICULOSITUACIONID';
 
    protected $allowedFields    = ['VEHICULOSITUACIONID','VEHICULOSITUACIONDESCR','VEHICULOSITUACIONACCION'];

   
}
