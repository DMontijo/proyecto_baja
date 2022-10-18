<?php

namespace App\Models;

use CodeIgniter\Model;

class RelacionFolioDocModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'RELACIONFOLIODOC';
    protected $allowedFields    = ['FOLIODOCID','FOLIOID','ANO','EXPEDIENTEID','EXPEDIENTEARCHIVOID'];

}
