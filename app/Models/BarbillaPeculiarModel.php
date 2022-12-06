<?php

namespace App\Models;

use CodeIgniter\Model;

class BarbillaPeculiarModel extends Model
{

    protected $table            = 'BARBILLAPECULIAR';
    protected $primaryKey       = 'BARBILLAPECULIARID';
    protected $allowedFields    = ['BARBILLAPECULIARID', 'BARBILLAPECULIARDESCR'];
}
