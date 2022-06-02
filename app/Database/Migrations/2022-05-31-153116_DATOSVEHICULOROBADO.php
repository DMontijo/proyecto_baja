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
			],
			'PLACAS' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
            'CONFIRM_PLACAS' => [
				'type' => 'TINYINT',
				'constraint' => '1',
			],
			'ESTADO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
			'SERIE' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'CONFIRM_SERIE' => [
				'type' => 'TINYINT',
				'constraint' => '1',
			],
            'DISTRIBUIDOR' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'MARCA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
            'LINEA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
            'VERSION' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
            'TIPO_VEHICULO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
            'SERVICIO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'MODELO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'SEGURO_VIGENTE' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'COLOR_VEHICULO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'COLOR_TAPICERIA' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'NUM_CHASIS' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'TRANSMISION' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'TRACCION_VEHICULO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'FOTO_VEHICULO' => [
				'type' => 'BLOB',
			],
            'DESCRIPCION_VEHICULO' => [
				'type' => 'VARCHAR',
				'constraint' => '300',
			],
            'DERECHOS_IMPUTADO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],

			'CREADO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'ACTUALIZADO DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID_VEHICULO', TRUE);
		$this->forge->createTable('DATOS_VEHICULO_ROBADO');
	}

	public function down()
	{
		$this->forge->dropTable('DATOS_VEHICULO_ROBADO');
	}
}
