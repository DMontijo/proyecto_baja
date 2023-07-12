<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaMoralGiroModel extends Model
{
    protected $table            = 'PERSONAMORALGIRO';
    protected $allowedFields    = ['PERSONAMORALGIROID','PERSONAMORALGIRODESCR'];

}
