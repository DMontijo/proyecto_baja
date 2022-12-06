<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioConsecutivoModel extends Model
{

	protected $table            = 'FOLIOCONSECUTIVO';
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
		$FOLIOID = ($this->asObject()->where('ANO', $year)->first())->CONSECUTIVO + 1;
		$this->set(['CONSECUTIVO' => $FOLIOID])->where('ANO', $year)->update();
		return array($FOLIOID, $year);
	}
}
