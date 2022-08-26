<?php

namespace App\Models;

use CodeIgniter\Model;

class OrejaTamanoModel extends Model
{
     protected $DBGroup          = 'default';
    protected $table            = 'OREJATAMANO';
    protected $primaryKey       = 'OREJATAMANOID';
    protected $allowedFields    = ['OREJATAMANOID','OREJATAMANODESCR'];
}
