<?php

namespace App\Models;

use CodeIgniter\Model;

class BarbaPeculiarModel extends Model
{
     
    protected $table            = 'BARBAPECULIAR';
    protected $primaryKey       = 'BARBAPECULIARID';
    
    protected $allowedFields    = ['BARBAPECULIARID','BARBAPECULIARDESCR'];

}
