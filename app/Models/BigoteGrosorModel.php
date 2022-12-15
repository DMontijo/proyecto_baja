<?php

namespace App\Models;

use CodeIgniter\Model;

class BigoteGrosorModel extends Model
{

    protected $table            = 'BIGOTEGROSOR';
    protected $primaryKey       = 'BIGOTEGROSORID';
    protected $allowedFields    = ['BIGOTEGROSORID', 'BIGOTEGROSORDESCR'];
}
