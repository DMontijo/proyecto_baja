<?php

namespace App\Models;

use CodeIgniter\Model;

class BigoteTamanoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'BIGOTETAMANO';
    protected $primaryKey       = 'BIGOTETAMANOID';
    protected $allowedFields    = ['BIGOTETAMANOID','BIGOTETAMANODESCR'];

}
