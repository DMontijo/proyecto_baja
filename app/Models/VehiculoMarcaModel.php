<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiculoMarcaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'VEHICULOMARCA';
    protected $allowedFields    = ['VEHICULODISTRIBUIDORID','VEHICULODISTRIBUIDORID','VEHICULOMARCADESCR'];

}
