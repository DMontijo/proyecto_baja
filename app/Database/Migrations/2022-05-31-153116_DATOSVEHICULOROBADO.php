<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DATOSVEHICULOROBADO extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'ID_VEHICULO' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
				'unique' => TRUE,
			],
			'TIPO_PLACAS' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'PLACAS' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'CONFIRM_PLACAS' => [
				'type' => 'TINYINT',
				'constraint' => '1',
				'null' => TRUE,
			],
			'ESTADO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'SERIE' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'CONFIRM_SERIE' => [
				'type' => 'TINYINT',
				'constraint' => '1',
				'null' => TRUE,
			],
			'DISTRIBUIDOR' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'MARCA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'LINEA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'VERSION' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'TIPO_VEHICULO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'SERVICIO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'MODELO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'SEGURO_VIGENTE' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'COLOR_VEHICULO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'COLOR_TAPICERIA' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'NUM_CHASIS' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'TRANSMISION' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'TRACCION_VEHICULO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'FOTO_VEHICULO' => [
				'type' => 'BLOB',
				'null' => TRUE,
			],
			'DESCRIPCION_VEHICULO' => [
				'type' => 'VARCHAR',
				'constraint' => '300',
				'null' => TRUE,
			],
			'DERECHOS_IMPUTADO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],

			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID_VEHICULO', TRUE);
		$this->forge->createTable('DATOS_VEHICULO_ROBADO');
	}

	public function down()
	{
		$this->forge->dropTable('DATOS_VEHICULO_ROBADO');
	}
}
