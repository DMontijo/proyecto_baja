<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioVehiculoModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIOVEHICULO';
	protected $allowedFields    = [
		'FOLIOID',
		'VEHICULOID',
		'ANO',
		'SITUACION',
		'TIPOID',
		'MARCAID',
		'MARCADESCR',
		'MODELOID',
		'MODELODESCR',
		'ANO',
		'PLACAS',
		'NUMEROSERIE',
		'NUMEROMOTOR',
		'NUMEROCHASIS',
		'TRANSMISION',
		'TRACCION',
		'PRIMERCOLORID',
		'SEGUNDOCOLORID',
		'SENASPARTICULARES',
		'PERSONAFISICAIDPROPIETARIO',
		'PERSONAMORALIDPROPIETARIO',
		'FOTO',
		'DOCUMENTO',
		'PARTICIPAESTADO',
		'TIPOPLACA',
		'ESTADOIDPLACA',
		'ESTADOEXTRANJEROIDPLACA',
		'VEHICULODISTRIBUIDORID',
		'VEHICULOVERSIONID',
		'VEHICULOSERVICIOID',
		'VEHICULOSTATUSID',
		'PROVIENEPADRON',
		'SEGUROVIGENTE',
	];

	public function get_by_folio($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOID', 'VEHICULOID', 'ANO','PLACAS','NUMEROSERIE']);
		$builder->where('FOLIOID', $folio);
		$builder->where('ANO', $year);
		$query = $builder->get();
		return $query->getResult('array');
	}
}
