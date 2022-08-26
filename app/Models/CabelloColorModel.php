<?php

namespace App\Models;

use CodeIgniter\Model;

class CabelloColorModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'CABELLOCOLOR';
    protected $primaryKey       = 'CABELLOCOLORID';
    protected $allowedFields    = ['CABELLOCOLORID','CABELLOCOLORDESCR'];

}
