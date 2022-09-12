<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpPersonaFisImpDelitoModel extends Model
{
    protected $DBGroup          = 'default';
	protected $table            = 'EXPPERSONAFISIMPDELITO';
	protected $allowedFields    = ['DELITOMODALIDADID','DELITOCARACTERISTICAID','TENTATIVA'];

}
