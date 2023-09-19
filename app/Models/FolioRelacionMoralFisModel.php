<?php

namespace App\Models;

use CodeIgniter\Model;

class FolioRelacionMoralFisModel extends Model
{

    protected $table            = 'FOLIORELACIONMORALFIS';
    protected $allowedFields    = ['FOLIOID', 'ANO', 'PERSONAMORALIDVICTIMA', 'DELITOMODALIDADID', 'PERSONAFISICAIDIMPUTADO', 'GRADOPARTICIPACIONID', 'TENTATIVA', 'CONVIOLENCIA'];

    public function get_by_folio($folio, $year)
    {

        $strQuery = 'SELECT 
	t1.FOLIOID, t1.ANO, t1.PERSONAMORALIDVICTIMA AS PERSONAMORALIDVICTIMA, NULL AS PERSONAFISICAIDVICTIMA,t1.DELITOMODALIDADID, t1.PERSONAFISICAIDIMPUTADO,
    t2.DENOMINACION AS NOMBREV, t2.MARCACOMERCIAL AS PAPELLIDOV, t5.PODERVOLUMEN AS SAPELLIDOA,
    t3.NOMBRE AS NOMBREI,t3.PRIMERAPELLIDO AS PAPELLIDOI,t3.SEGUNDOAPELLIDO AS SAPELLIDOI,
    t4.DELITOMODALIDADDESCR
	FROM FOLIORELACIONMORALFIS t1
    LEFT JOIN FOLIOPERSONAMORAL t2 ON t2.PERSONAMORALID = t1.PERSONAMORALIDVICTIMA
    LEFT JOIN RELACIONPODERLITIGANTE t5 ON t5.PODERID = t2.PODERID
    LEFT JOIN FOLIOPERSONAFISICA t3 ON t3.PERSONAFISICAID = t1.PERSONAFISICAIDIMPUTADO
    LEFT JOIN DELITOMODALIDAD t4 ON t4.DELITOMODALIDADID = t1.DELITOMODALIDADID
    WHERE
		t1.FOLIOID =' . $folio . ' AND t1.ANO = ' . $year . ' AND t2.FOLIOID =' . $folio . ' AND t2.ANO = ' . $year . ' AND t3.FOLIOID =' . $folio . ' AND t3.ANO = ' . $year . '
UNION 
 SELECT 
	t1.FOLIOID, t1.ANO, NULL AS PERSONAMORALIDVICTIMA,t1.PERSONAFISICAIDVICTIMA AS PERSONAFISICAIDVICTIMA,t1.DELITOMODALIDADID, t1.PERSONAFISICAIDIMPUTADO,
    t2.NOMBRE AS NOMBREV, t2.PRIMERAPELLIDO AS PAPELLIDOV, t2.SEGUNDOAPELLIDO AS SAPELLIDOA,
    t3.NOMBRE AS NOMBREI,t3.PRIMERAPELLIDO AS PAPELLIDOI,t3.SEGUNDOAPELLIDO AS SAPELLIDOI,
    t4.DELITOMODALIDADDESCR
	FROM FOLIORELACIONFISFIS t1
    LEFT JOIN FOLIOPERSONAFISICA t2 ON t2.PERSONAFISICAID = t1.PERSONAFISICAIDVICTIMA
    LEFT JOIN FOLIOPERSONAFISICA t3 ON t3.PERSONAFISICAID = t1.PERSONAFISICAIDIMPUTADO
    LEFT JOIN DELITOMODALIDAD t4 ON t4.DELITOMODALIDADID = t1.DELITOMODALIDADID
    WHERE 
    t1.FOLIOID =' . $folio . ' AND t1.ANO = ' . $year . ' AND t2.FOLIOID =' . $folio . ' AND t2.ANO = ' . $year . ' AND t3.FOLIOID =' . $folio . ' AND t3.ANO = ' . $year;
        return $this->db->query($strQuery)->getResult('array');
    }
    public function count_delitosMoralFis($folio, $year, $delito, $imputado)
    {
        $builder = $this->db->table($this->table);
        $builder->selectCount('DELITOMODALIDADID');
        $builder->where('FOLIOID', $folio);
        $builder->where('ANO', $year);
        $builder->where('DELITOMODALIDADID', $delito);
        $builder->where('PERSONAFISICAIDIMPUTADO', $imputado);

        $query = $builder->get();
        return $query->getResult();
    }
}
