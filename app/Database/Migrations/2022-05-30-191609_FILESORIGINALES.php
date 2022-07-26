<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FILESORIGINALES extends Migration
{
	public function up()
	{
		$this->forge->addField([

			'ID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'DESCRIPCION'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
			],
			'TITULO'          => [
				'type'           => 'TEXT',
			],
			'PLACEHOLDER'          => [
				'type'           => 'TEXT',
			],
			'OPCIONES'          => [
				'type'           => 'TEXT',
			],
			'TIPO_ARCHIVO'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
			],
			'RELACIONADO_CON'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
			],
			'MODIFICADO'          => [
				'type'           => 'TINYINT',
				'default'     => '0',
			],
			'ELIMINADO'          => [
				'type'           => 'TINYINT',
				'default'     => '0',
			],
			'ID_DENUNCIANTE'          => [
				'type'           => 'INT',
			],

		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('PLANTILLAS');
	}

	public function down()
	{
		$this->forge->dropTable('PLANTILLAS');
	}
}
