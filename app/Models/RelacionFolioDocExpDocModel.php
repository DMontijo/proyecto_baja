<?php

namespace App\Models;

use CodeIgniter\Model;

class RelacionFolioDocExpDocModel extends Model
{
    protected $table            = 'RELACIONFOLIODOCEXPDOC';
	protected $allowedFields    = ['FOLIODOCID', 'FOLIOID', 'ANO', 'EXPEDIENTEID', 'EXPEDIENTEDOCID'];
}
