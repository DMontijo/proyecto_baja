<?php

namespace App\Models;

use CodeIgniter\Model;

class DelitoModalidadModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'DELITOMODALIDAD';
	protected $allowedFields    = ['DELITOMODALIDADID','DELITOMODALIDADDESCR','DELITOMODALIDADARTICULO','DELITOCAPITULOID','DELITOCLASIFICACION','DELITOPERSONAL','HABILITADO','DELITOPESO','INTENCIONALIDADID','TIPOQUERELLA'];
}
