<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaEtniaModel extends Model
{

    protected $table            = 'PERSONAETNIA';
    protected $primaryKey       = 'PERSONAETNIAID';
    protected $allowedFields    = ['PERSONAETNIAID', 'PERSONAETNIADESCR'];
}
