<?php

namespace App\Models;

use CodeIgniter\Model;

class CabelloEstiloModel extends Model
{

    protected $table            = 'CABELLOESTILO';
    protected $primaryKey       = 'CABELLOESTILOID';
    protected $allowedFields    = ['CABELLOESTILOID', 'CABELLOESTILODESCR'];
}
