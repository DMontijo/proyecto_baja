<?php

namespace App\Database\Seeds;

use App\Controllers\admin\DocumentosController;
use App\Models\UsuariosModel;
use CodeIgniter\Database\Seeder;

class RolesPermisosSeeder extends Seeder
{
    public function run()
    {

		$data = [
			array('ROLID' => '1', 'PERMISOID'=>'1'),
            array('ROLID' => '1', 'PERMISOID'=>'2'),
            array('ROLID' => '1', 'PERMISOID'=>'3'),
            array('ROLID' => '1', 'PERMISOID'=>'4'),
            array('ROLID' => '1', 'PERMISOID'=>'5'),
            array('ROLID' => '1', 'PERMISOID'=>'6'),
            array('ROLID' => '1', 'PERMISOID'=>'7'),
            array('ROLID' => '1', 'PERMISOID'=>'8'),
            array('ROLID' => '1', 'PERMISOID'=>'9'),
            array('ROLID' => '1', 'PERMISOID'=>'10'),

            array('ROLID' => '2', 'PERMISOID'=>'1'),
            array('ROLID' => '2', 'PERMISOID'=>'2'),
            array('ROLID' => '2', 'PERMISOID'=>'4'),

            array('ROLID' => '3', 'PERMISOID'=>'4'),
            array('ROLID' => '3', 'PERMISOID'=>'5'),
            array('ROLID' => '3', 'PERMISOID'=>'6'),

            array('ROLID' => '4', 'PERMISOID'=>'6'),

            array('ROLID' => '5', 'PERMISOID'=>'6'),

            array('ROLID' => '6', 'PERMISOID'=>'9'),



		];
		$this->db->table('ROLESPERMISOS')->insertBatch($data);
    }
}
