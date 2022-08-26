<?php

namespace App\Models;

use CodeIgniter\Model;

class OjoColorModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'OJOCOLOR';
    protected $primaryKey       = 'OJOCOLORID';
    protected $allowedFields    = ['OJOCOLORID','OJOCOLORDESCR'];
}
