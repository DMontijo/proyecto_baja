<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'FOLIO';
	protected $allowedFields    = [
		'FOLIOID',
		'EXPEDIENTEID',
		'DENUNCIANTEID',
		'AGENTEATENCIONID',
		'AGENTEFIRMAID',
		'STATUS',
		'NOTASAGENTE',
		'ENLACEVIDEO',
		'ESTADOID',
		'MUNICIPIOID',
		'ANO',
		'CORRELATIVO',
		'HECHOMEDIOCONOCIMIENTOID',
		'HECHOFECHA',
		'HECHOHORA',
		'HECHOLUGARID',
		'HECHOESTADOID',
		'HECHOMUNICIPIOID',
		'HECHOLOCALIDADID',
		'HECHODELEGACIONID',
		'HECHOZONA',
		'HECHOCOLONIAID',
		'HECHOCOLONIADESCR',
		'HECHOCALLE',
		'HECHONUMEROCASA',
		'HECHONUMEROCASAINT',
		'HECHOREFERENCIA',
		'HECHONARRACION',
		'TIPOEXPEDIENTEID',
		'PARTICIPAESTADO',
		'EMPLEADOIDREGISTRO',
		'OFICINAIDRESPONSABLE',
		'CONFIDENCIAL',
		'ESTADOJURIDICOEXPEDIENTEID',
		'RELACIONDOCUMENTOS',
		'HECHOCOORDENADAX',
		'HECHOCOORDENADAY',
		'PARTENUMERO',
		'PARTEFECHA',
		'PARTEAUTORIDADID',
		'PARTEAREADOID',
		'PARTEEMPLEADOID',
		'EXHORTONUMERO',
		'EXHORTOESTADOID',
		'EXHORTOMUNICIPIOID',
		'EXHORTOOFICINAID',
		'AREAIDREGISTRO',
		'AREAIDRESPONSABLE',
		'LOCALIZACIONPERSONA',
		'CONCLUIDO',
		'EXHORTOAUTORIDADID',
		'HECHOCLASIFICACIONLUGARID',
		'HECHOVIALIDADID',
		'DELITODENUNCIA',
		'DERECHOS',
	];
}
