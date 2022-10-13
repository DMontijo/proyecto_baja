<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioDocModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'FOLIODOC';

    protected $allowedFields    = [
        'FOLIODOCID',
        'FOLIOID',
        'ANO',
        'DENUNCIANTEID',
        'ESTADOID',
        'MUNICIPIOID',
        'NUMEROEXPEDIENTE',
        'TIPODOC',
        'PLACEHOLDER',
        'OFICINAID',
        'AGENTEID',
        'NUMEROIDENTIFICADOR',
        'RAZONSOCIALFIRMA',
        'RFCFIRMA',
        'NCERTIFICADOFIRMA',
        'FECHAFIRMA',
        'HORAFIRMA',
        'LUGARFIRMA',
        'CADENAFIRMADA',
        'FIRMAELECTRONICA',
        'PDF',
        'STATUS',
        'STATUSENVIO',
		'ENVIADO',

    ];
    public function get_by_folio($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOID', 'FOLIODOCID', 'ANO', 'TIPODOC', 'STATUS', 'PLACEHOLDER']);
		$builder->where('FOLIOID', $folio);
		$builder->where('ANO', $year);
		$builder->orderBy('FOLIODOCID ASC');
		$query = $builder->get();
		return $query->getResult('array');
	}
    public function get_by_expediente($folio, $year)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOID', 'FOLIODOCID', 'ANO', 'TIPODOC', 'STATUS', 'PLACEHOLDER','NUMEROEXPEDIENTE','RAZONSOCIALFIRMA']);
		$builder->where('NUMEROEXPEDIENTE', $folio);
		$builder->where('ANO', $year);
		$builder->orderBy('FOLIODOCID ASC');
		$query = $builder->get();
		return $query->getResult('array');
	}
    public function get_folio_abierto()
	{
		$builder = $this->db->table($this->table);
		$builder->select(['NUMEROEXPEDIENTE', 'FECHAREGISTRO','STATUS','ANO']);
		$builder->where('STATUS', 'ABIERTO');
		$builder->orderBy('NUMEROEXPEDIENTE ASC');
        $builder->groupBy('NUMEROEXPEDIENTE');
		$query = $builder->get();
		return $query->getResult('array');
	}
    public function get_folio_firmado()
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOID','NUMEROEXPEDIENTE', 'FECHAREGISTRO','STATUS','ANO']);
		$builder->where('STATUS', 'FIRMADO');
		$builder->orderBy('NUMEROEXPEDIENTE ASC');
        $builder->groupBy('NUMEROEXPEDIENTE');
		$query = $builder->get();
		return $query->getResult('array');
	}
	public function get_folio_by_first($folio, $year, $docid)
	{
		$builder = $this->db->table($this->table);
		$builder->select(['FOLIOID','NUMEROEXPEDIENTE', 'FECHAREGISTRO','STATUS','ANO', 'PLACEHOLDER']);
		$builder->where('FOLIOID', $folio);
		$builder->where('ANO', $year);
		$builder->where('FOLIODOCID', $docid);
		$query = $builder->get();
		foreach ($query->getResult() as $row) {
			$result = $row->PLACEHOLDER;
		}
		return $result;
	}
}
