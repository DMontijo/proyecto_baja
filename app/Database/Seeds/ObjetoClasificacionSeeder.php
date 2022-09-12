<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ObjetoClasificacionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('OBJETOCLASIFICACIONDESCR'=>'ELECTRO DOMESTICOS'),
            array('OBJETOCLASIFICACIONDESCR'=>'MUEBLES'),
            array('OBJETOCLASIFICACIONDESCR'=>'ELECTRICOS'),
            array('OBJETOCLASIFICACIONDESCR'=>'EQUIPO COMUNICACIÓN'),
            array('OBJETOCLASIFICACIONDESCR'=>'VALORES'),
            array('OBJETOCLASIFICACIONDESCR'=>'ARMAS'),
            array('OBJETOCLASIFICACIONDESCR'=>'DOCUMENTOS'),
            array('OBJETOCLASIFICACIONDESCR'=>'OBRAS DE ARTE'),
            array('OBJETOCLASIFICACIONDESCR'=>'MISCELANEOS'),
            array('OBJETOCLASIFICACIONDESCR'=>'PLACAS'),
        ];
        $this->db->table('OBJETOCLASIFICACION')->insertBatch($data);

    }
}
