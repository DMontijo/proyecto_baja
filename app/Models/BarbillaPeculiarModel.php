<?php

namespace App\Models;

use CodeIgniter\Model;

class BarbillaPeculiarModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'BARBILLAPECULIAR';
    protected $primaryKey       = 'BARBILLAPECULIARID';
    protected $allowedFields    = ['BARBILLAPECULIARID','BARBILLAPECULIARDESCR'];
}
