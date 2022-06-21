<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpleadosModel extends Model
{
	protected $table = "EMPLEADOS";
	protected $primarykey = "EMPLEADOID";
	protected $allowedFields    = [
		'EMPLEADOID',
		'NOMBRE',
		'PRIMERAPELLIDO',
		'SEGUNDOAPELLIDO',
		'MUNICIPIOID',
		'ESTADOID',
		'OFICINAID',
		'AREAID',
	];
}
