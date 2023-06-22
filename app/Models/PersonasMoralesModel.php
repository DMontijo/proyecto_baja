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
		'FECHAREGISTRO',
		'FECHAACTUALIZACION'
	];
}
