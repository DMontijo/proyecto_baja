<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MedioConocimientoSeeder extends Seeder
{
    public function run()
    {
        $data=[
            array('MEDIOCONOCIMIENTODESCR' => 'ELECTRONICO','COMPORTAMIENTO' =>'DATOSAVISO'),
            array('MEDIOCONOCIMIENTODESCR' => 'VERBAL','COMPORTAMIENTO' =>'DATOSPERSONA'),
            array('MEDIOCONOCIMIENTODESCR' => 'ESCRITA','COMPORTAMIENTO' =>'DATOSDOCTO'),
            array('MEDIOCONOCIMIENTODESCR' => 'TELEFONICA','COMPORTAMIENTO' =>'DATOSAVISO'),
            array('MEDIOCONOCIMIENTODESCR' => 'PARTE POLICIAL','COMPORTAMIENTO' =>'PARTE')           
        ];
       $this->db->table('CATEGORIA_MEDIOCONOCIMIENTO')->insertBatch($data);
    }
}
