<?php

namespace App\Models;

use CodeIgniter\Model;

class ParentescoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'PERSONAPARENTESCO';
    protected $primaryKey       = 'PERSONAPARENTESCOID';
    protected $allowedFields    = ['PERSONAPARENTESCOID','PERSONAPARENTESCODESCR'];

}
