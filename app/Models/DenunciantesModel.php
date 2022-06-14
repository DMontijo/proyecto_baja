<?php

namespace App\Models;

use CodeIgniter\Model;

class DenunciantesModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'DENUNCIANTES';
	protected $primaryKey       = 'ID_DENUNCIANTE';
	protected $allowedFields    = [
		'NOMBRE',
		'APELLIDO_PATERNO',
		'APELLIDO_MATERNO',
		'CORREO',
		'PASSWORD',
		'FECHA_DE_NACIMIENTO',
		'EDAD',
		'SEXO',
		'CODIGO_POSTAL',
		'PAIS',
		'ESTADOID',
		'MUNICIPIOID',
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
		'TIPO_DE_IDENTIFICACION',
		'NUMERO_DE_IDENTIFICACION',
		'ESTADO_CIVIL',
		'OCUPACION',
		'IDENTIDAD_DE_GENERO',
		'DISCAPACIDAD',
		'NACIONALIDAD_ID',
		'ESCOLARIDAD',
		'IDIOMAID',
		'DOCUMENTO',
		'FIRMA',
		'NOTIFICACIONES',
	];
}
