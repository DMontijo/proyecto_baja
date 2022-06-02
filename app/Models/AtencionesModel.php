<?php

namespace App\Models;

use CodeIgniter\Model;

class AtencionesModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'ATENCION_CLIENTE';
	protected $allowedFields    = [
		'FOLIO',
		'FECHA_HORA',
		'IDMUNICIPIO',
		'IDCIUDADANO',
		'IDEXPEDIENTE',
		'IDDERIVACION',
		'IDAGENTE',
		'ID_DENUNCIA',
		'ID_DATOS_DELITO',
		'ID_DATOS_DEL_RESPONSABLE',
		'ID_DATOS_ADULTO_ACOMPANANTE',
		'ID_DATOS_MENOR_EDAD',
		'ID_DATOS_PERSONA_DESAPARECIDA',
		'ID_DATOS_ROBO_VEHICULO',
		'ID_MODULO_SEJAP',
		'NOTAS',
	];
}
