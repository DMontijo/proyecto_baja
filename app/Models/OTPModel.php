<?php

namespace App\Models;

use CodeIgniter\Model;

class OTPModel extends Model
{

	protected $table            = 'OTP';
	protected $allowedFields = [
		'CODIGO_OTP',
		'CORREO',
		'CREADO',
		'VENCIMIENTO',
	];
}
