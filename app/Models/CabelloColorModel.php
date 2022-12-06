<?php

namespace App\Models;

use CodeIgniter\Model;

class CabelloColorModel extends Model
{

    protected $table            = 'CABELLOCOLOR';
    protected $primaryKey       = 'CABELLOCOLORID';
    protected $allowedFields    = ['CABELLOCOLORID', 'CABELLOCOLORDESCR'];
}
