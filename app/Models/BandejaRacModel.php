<?php

namespace App\Models;

use CodeIgniter\Model;

class BandejaRacModel extends Model
{
    protected $table            = 'BANDEJARAC';
    
    
    protected $allowedFields    = ['FOLIOID','ANO', 'EXPEDIENTEID','MODULOID','MODULODESCR','MEDIADORID','TIPOPROCEDIMIENTOID'];
}
