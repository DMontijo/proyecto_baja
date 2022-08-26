<?php

namespace App\Models;

use CodeIgniter\Model;

class DenunciantesModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'DENUNCIANTES';
	protected $primaryKey       = 'DENUNCIANTEID';
	protected $allowedFields    = [
		'DENUNCIANTEID',
		'NOMBRE',
		'APELLIDO_PATERNO',
		'APELLIDO_MATERNO',
		'CORREO',
		'PASSWORD',
		'FECHANACIMIENTO',
		'SEXO',
		'CODIGOPOSTAL',
		'PAIS',
		'ESTADOID',
		'ESTADOORIGENID',
		'MUNICIPIOID',
		'MUNICIPIOORIGENID',
		'LOCALIDADID',
		'COLONIAID',
		'COLONIA',
		'CALLE',
		'NUM_EXT',
		'NUM_INT',
		'TELEFONO',
		'TELEFONO2',
		'CODIGO_PAIS',
		'CODIGO_PAIS2',
		'TIPOIDENTIFICACIONID',
		'NUMEROIDENTIFICACION',
		'ESTADOCIVILID',
		'IDENTIDADGENERO',
		'DISCAPACIDAD',
		'NACIONALIDADID',
		'ESCOLARIDADID',
		'OCUPACIONID',
		'FACEBOOK',
		'INSTAGRAM',
		'TWITTER',
		'IDIOMAID',
		'DOCUMENTO',
		'FIRMA',
		'NOTIFICACIONES',
		'LEER',
		'ESCRIBIR',
		'APOYO',
		'TIPO',
	];
}
