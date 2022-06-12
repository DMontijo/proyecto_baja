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
				'null' => TRUE,
			],
			'ALIAS' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'PRIMER_APELLIDO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
            'SEGUNDO_APELLIDO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
            'MUNICIPIO_IMPUTADO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'CALLE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'NO_EXT_IMPUTADO' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
			'NO_INT_IMPUTADO' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
            'TELEFONO' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
            'FECHA_NACIMIENTO' => [
				'type' => 'DATE',
				'null' => TRUE,
			],
            'SEXO' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
            'ESCOLARIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'DESCRIPCION_FISICA' => [
				'type' => 'VARCHAR',
				'constraint' => '300',
				'null' => TRUE,
			],

			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID_RESPONSABLE', TRUE);
		$this->forge->createTable('DATOS_RESPONSABLE');
	}

	public function down()
	{
		$this->forge->dropTable('DATOS_RESPONSABLE');
	}
}
