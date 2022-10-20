<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiculoModeloModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'VEHICULOMODELO';
 
    protected $allowedFields    = ['VEHICULODISTRIBUIDORID','VEHICULOMARCAID','VEHICULOMODELOID','VEHICULOMODELODESCR'];

}
