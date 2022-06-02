<?php

namespace App\Models;

use CodeIgniter\Model;

class Datos_vehiculoModel extends Model

{   
    protected $DBGroup          = 'default';
	protected $table            = 'DATOS_VEHICULO_ROBADO';
	protected $primaryKey       = 'ID';
	protected $allowedFields    = [
        'TIPO_PLACAS',
        'PLACAS',
        'CONFIRM_PLACAS',
        'ESTADO',
        'SERIE',
        'CONFIRM_SERIE',
        'DISTRIBUIDOR',
        'MARCA',
        'LINEA',
        'VERSION',
        'TIPO_VEHICULO',
        'SERVICIO',
        'MODELO',
        'SEGURO_VIGENTE',
        'COLOR_VEHICULO',
        'COLOR_TAPICERIA',
        'NUM_CHASIS',
        'TRANSMISION',
        'TRACCION_VEHICULO',
        'FOTO_VEHICULO',
        'DESCRIPCION_VEHICULO',
        'DERECHOS_IMPUTADO',

	];
}