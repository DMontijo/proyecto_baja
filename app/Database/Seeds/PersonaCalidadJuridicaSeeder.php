<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PersonaCalidadJuridicaSeeder extends Seeder
{
    public function run()
    {
        $data=[
            array('PERSONACALIDADJURIDICADESCR' => 'OFENDIDO','COMPORTAMIENTO' =>'VIC'),
            array('PERSONACALIDADJURIDICADESCR' => 'IMPUTADO','COMPORTAMIENTO' =>'IMP'),
            array('PERSONACALIDADJURIDICADESCR' => 'TESTIGO','COMPORTAMIENTO' =>'TEST'),
            array('PERSONACALIDADJURIDICADESCR' => 'TERCERO','COMPORTAMIENTO' =>'TER'),
            array('PERSONACALIDADJURIDICADESCR' => 'REPRESENTANTE LEGAL','COMPORTAMIENTO' =>'TER'),
            array('PERSONACALIDADJURIDICADESCR' => 'VICTIMA','COMPORTAMIENTO' =>'VIC'),
            array('PERSONACALIDADJURIDICADESCR' => 'COMPARECIENTE','COMPORTAMIENTO' =>'VIC'),
           
           
        ];
        $this->db->table('CATEGORIA_PERSONACALIDADJURIDICA')->insertBatch($data);
    }
}
