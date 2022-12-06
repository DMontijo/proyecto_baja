<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiculoDistribuidorModel extends Model
{

    protected $table            = 'VEHICULODISTRIBUIDOR';
    protected $primaryKey       = 'VEHICULODISTRIBUIDORID';

    protected $allowedFields    = ['VEHICULODISTRIBUIDORID', 'VEHICULODISTRIBUIDORDESCR'];
}
