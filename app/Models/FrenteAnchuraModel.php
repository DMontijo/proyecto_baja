<?php

namespace App\Models;

use CodeIgniter\Model;

class FrenteAnchuraModel extends Model
{

    protected $table            = 'FRENTEANCHURA';
    protected $primaryKey       = 'FRENTEANCHURAID';
    protected $allowedFields    = ['FRENTEANCHURAID', 'FRENTEANCHURADESCR'];
}
