<?php

namespace App\Models;

use CodeIgniter\Model;

class FileOriginalesModel extends Model
{
    protected $DBGroup          = 'default';
	protected $table            = 'FILES_ORIGINALES';
	protected $allowedFields    = ['ID, DESCRIPCION, TITULO, PLACEHOLDER, OPCIONES,TIPO_ARCHIVO, RELACIONADO_CON, MODIFICADO, ELIMINADO, DENUNCIANTEID'];
}
