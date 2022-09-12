<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpRelacionFisFisModel extends Model
{
    protected $DBGroup          = 'default';
	protected $table            = 'EXPRELACIONFISFIS';
	protected $allowedFields    = ['FOLIOID','ANO','PERSONAFISICAIDVICTIMA','DELITOMODALIDADID','PERSONAFISICAIDIMPUTADO','GRADOPARTICIPACIONID','TENTATIVA','CONVIOLENCIA'];

}
