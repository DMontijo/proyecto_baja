<?php

namespace App\Models;

use CodeIgniter\Model;

class BarbillaFormaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'BARBILLAFORMA';
    protected $primaryKey       = 'BARBILLAFORMAID';
    protected $allowedFields    = ['BARBILLAFORMAID','BARBILLAFORMADESCR'];

}
