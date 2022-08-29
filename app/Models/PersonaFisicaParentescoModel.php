<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaFisicaParentescoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'FOLIORELACIONPARENTESCO';
    protected $allowedFields    = ['FOLIOID','ANO', 'PARENTESCOID', 'PERSONAFISICAID1','PERSONAFISICAID2'];

}
