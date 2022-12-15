<?php

namespace App\Models;

use CodeIgniter\Model;

class ConstanciaExtravioConsecutivoModel extends Model
{

	protected $table            = 'CONSTANCIAEXTRAVIOCONSECUTIVO';
	protected $primaryKey       = 'ANO';
	protected $allowedFields    = [
		'ANO',
		'CONSECUTIVO',
	];

	public function get_consecutivo()
	{
		$year = date('Y');
		$exist = $this->where('ANO', $year)->first();
		if (!$exist) {
			$this->insert(['ANO' => $year, 'CONSECUTIVO' => 0]);
		}
		$CONSECUTIVO = ($this->asObject()->where('ANO', $year)->first())->CONSECUTIVO + 1;
		$this->set(['CONSECUTIVO' => $CONSECUTIVO])->where('ANO', $year)->update();
		return array($CONSECUTIVO, $year);
	}
}
