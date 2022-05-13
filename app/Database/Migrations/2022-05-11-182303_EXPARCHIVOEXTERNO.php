<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPARCHIVOEXTERNO extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'EXPEDIENTEARCHIVOID'          => [
				'type'           => 'INT',
				'auto_increment' => TRUE
			],
			'EXPEDIENTEID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'ARCHIVODESCR'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '200',
				'null' => TRUE,
			],
			'CLASIFICACIONID'       => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'ARCHIVO'          => [
				'type'           => 'BLOB',
				'null' => TRUE,
			],
			'EXTENSION'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '5',
				'null' => TRUE,
			],
			'FECHAACTUALIZACION'          => [
				'type'           => 'DATE',
				'null' => TRUE,
			],
			'AUTOR'          => [
				'type'           => 'INT',
				'null' => TRUE,
			],
			'OFICINAIDAUTOR'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'CLASIFICACIONDOCTOID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'ESTADOACCESO'       => [
				'type'           => 'CHAR',
				'constraint'     => '1',
				'default' => 'M',
				'null' => TRUE,
			],
			'PUBLICADO'       => [
				'type'           => 'CHAR',
				'constraint'     => '1',
				'default' => 'N',
				'null' => TRUE,
			],
			'RUTAALMACENAMIENTOID'       => [
				'type'           => 'INT',
				'null' => TRUE,
			],
			'STATUSALMACENID'       => [
				'type'           => 'INT',
				'null' => TRUE,
			],
			'EXPORTAR'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '10',
				'null' => TRUE,
			],
		]);
		$this->forge->addKey('EXPEDIENTEARCHIVOID', TRUE);
		$this->forge->addForeignKey('EXPEDIENTEID', 'EXPEDIENTE', 'EXPEDIENTEID');
		$this->forge->addForeignKey('OFICINAIDAUTOR', 'OFICINA', 'OFICINAID');
		/*    $this->forge->addForeignKey('CLASIFICACIONDOCTOID', '', '');
        $this->forge->addForeignKey('RUTAALMACENAMIENTOID', '', '');
        $this->forge->addForeignKey('STATUSALMACENID', '', '');
      */
		$this->forge->createTable('EXPARCHIVOEXTERNO');
	}

	public function down()
	{
		$this->forge->dropTable('EXPARCHIVOEXTERNO');
	}
}
