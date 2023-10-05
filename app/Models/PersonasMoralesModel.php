<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonasMoralesModel extends Model
{
	protected $table            = 'PERSONASMORALES';
	protected $allowedFields    = [
		'PERSONAMORALID',
		'RAZONSOCIAL',
		'MARCACOMERCIAL',
		'RFC',
		'PERSONAMORALGIROID',
		'ESTADOID',
		'MUNICIPIOID',
		'LOCALIDADID',
		'ZONA',
		'COLONIAID',
		'COLONIADESCR',
		'CALLE',
		'NUMERO',
		'NUMEROINTERIOR',
		'REFERENCIA',
		'TELEFONO',
		'CORREO',
		'CARGO',
		'DESCRIPCIONCARGO',
		'CAMBIO',
		'FECHAREGISTRO',
		'FECHAACTUALIZACION',
		'PODERID'
	];
}
