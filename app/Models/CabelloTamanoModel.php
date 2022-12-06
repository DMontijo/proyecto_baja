<?php

namespace App\Models;

use CodeIgniter\Model;

class CabelloTamanoModel extends Model
{

    protected $table            = 'CABELLOTAMANO';
    protected $primaryKey       = 'CABELLOTAMANOID';
    protected $allowedFields    = ['CABELLOTAMANOID', 'CABELLOTAMANODESCR'];
}
