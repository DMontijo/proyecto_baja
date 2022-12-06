<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiculoVersionModel extends Model
{

    protected $table            = 'VEHICULOVERSION';
    protected $allowedFields    = ['VEHICULODISTRIBUIDORID', 'VEHICULOMARCAID', 'VEHICULOMODELOID', 'VEHICULOVERSIONID', 'VEHICULOVERSIONDESCR'];
}
