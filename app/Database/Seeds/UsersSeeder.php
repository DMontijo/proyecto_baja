<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data=[
            array('NOMBRE' => 'ANDREA', 'APELLIDO_PATERNO'=>'SOLORZANO','APELLIDO_MATERNO'=>'GUTIERREZ','SEXO_BIOLOGICO'=>'MUJER','CORREO'=>'ANDREA.SOLORZANO@YOCONTIGO-IT.COM','PASSWORD'=>'ADMIN','HUELLA_DIGITAL'=>'SI','FIRMA_DIGITAL'=>'SI','IDPERFIL'=>'1'),
        ];
        $this->db->table('USUARIOS')->insertBatch($data);
    }
}
