<?php

namespace App\Models;

use CodeIgniter\Model;

class LabioPosicionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'LABIOPOSICION';
    protected $primaryKey       = 'LABIOPOSICIONID';
    protected $allowedFields    = ['LABIOPOSICIONID','LABIOPOSICIONDESCR'];
}
