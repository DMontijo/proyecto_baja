<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DATOSDELRESPONSABLE extends Migration
{
    public function up()
	{

		$this->forge->addField([
			'ID_RESPONSABLE' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
				'unique' => TRUE,
			],
			'NOMBRE_IMPUTADO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'ALIAS' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'PRIMER_APELLIDO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
            'SEGUNDO_APELLIDO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
            'MUNICIPIO_IMPUTADO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
			'CALLE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'NO_EXT_IMPUTADO' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
			'NO_INT_IMPUTADO' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
            'TELEFONO' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
            'FECHA_NACIMIENTO' => [
				'type' => 'DATE',
			],
            'SEXO' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
            'ESCOLARIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'DESCRIPCION_FISICA' => [
				'type' => 'VARCHAR',
				'constraint' => '300',
			],

			'CREADO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'ACTUALIZADO DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID_RESPONSABLE', TRUE);
		$this->forge->createTable('DATOS_RESPONSABLE');
	}

	public function down()
	{
		$this->forge->dropTable('DATOS_RESPONSABLE');
	}
}
