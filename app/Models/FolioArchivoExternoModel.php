<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioArchivoExternoModel extends Model
{

    protected $table = 'FOLIOARCHIVOEXTERNO';

    protected $allowedFields = [
        'FOLIOID',
		'ANO',
		'FOLIOARCHIVOID',
		'ARCHIVODESCR',
		'ARCHIVO',
        'EXTENSION',
		'FECHAACTUALIZACION',
		'AUTOR',
		'OFICINAIDAUTOR',
		'CLASIFICACIONDOCTOID',
		'ESTADOACCESO',
		'PUBLICADO',
		'RUTAALMACENAMIENTOID',
		'STATUSALMACENID',
		'EXPORTAR'
    ];
	public function get_by_folio($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOID', 'FOLIOARCHIVOID', 'ANO', 'ARCHIVODESCR', 'FECHAREGISTRO','EXTENSION','ARCHIVO']);
		$builder->where('FOLIOID', $folio);
		$builder->where('ANO', $year);
		$builder->orderBy('FECHAREGISTRO ASC');
		$query = $builder->get();
		return $query->getResult('array');
	}
	
}
