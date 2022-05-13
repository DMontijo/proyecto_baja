<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoExpedienteSeeder extends Seeder
{
    public function run()
    {
        $data=[

            array('TIPOEXPEDIENTEDESCR' => '(NUC) CASO DE INVESTIGACION','TIPOEXPEDIENTECLAVE' =>'NUC','EDOJURIDICOIMPINICIALID' =>'1','PERMITECONCLUIR' =>'S'),
            array('TIPOEXPEDIENTEDESCR' => '(NAC) ACTA CIRCUNSTANCIADA','TIPOEXPEDIENTECLAVE' =>'NAC','EDOJURIDICOIMPINICIALID' =>'1','PERMITECONCLUIR' =>'S'),
            array('TIPOEXPEDIENTEDESCR' => '(RAC) REGISTRO DE ATENCION CIUDADANA','TIPOEXPEDIENTECLAVE' =>'RAC','EDOJURIDICOIMPINICIALID' =>'4','PERMITECONCLUIR' =>'N'),
            array('TIPOEXPEDIENTEDESCR' => '(EXH) EXHORTO','TIPOEXPEDIENTECLAVE' =>'EXH','EDOJURIDICOIMPINICIALID' =>'1','PERMITECONCLUIR' =>'S'),
            array('TIPOEXPEDIENTEDESCR' => '(NAV) ATENCION A VICTIMAS DEL DELITO','TIPOEXPEDIENTECLAVE' =>'NUV','EDOJURIDICOIMPINICIALID' =>'1','PERMITECONCLUIR' =>'N'),
            array('TIPOEXPEDIENTEDESCR' => '(NCE) CONSTANCIA DE EXTRAVIO','TIPOEXPEDIENTECLAVE' =>'NCE','EDOJURIDICOIMPINICIALID' =>'4','PERMITECONCLUIR' =>'N'),
           
        ];
        $this->db->table('CATEGORIA_TIPOEXPEDIENTE')->insertBatch($data);
    }
}
