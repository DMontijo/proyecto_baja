<?php

namespace App\Models;

use CodeIgniter\Model;

class RelacionPoderLitigante extends Model
{
    protected $table            = 'RELACIONPODERLITIGANTE';

    protected $allowedFields    = ['PERSONAFISICAID','PERSONAMORALID','PODERVOLUMEN','PODERNONOTARIO','PODERNOPODER','NOMBREARCHIVO','PODERARCHIVO','FECHAINICIOPODER','FECHAFINPODER', 'ACTIVO','CARGO','DESCRIPCIONCARGO',];
}
