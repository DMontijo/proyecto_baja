<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIODOCUMENTO extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'FOLIOID' => [
				'type' => 'VARCHAR',
				'constraint' => '16',
			],
			'FOLIODOCTOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'DOCTODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'DOCUMENTO' => [
				'type' => 'BLOB',
				'null' => TRUE,
			],
			'FECHACREACION DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
			'FECHAIMPRESODEFINITIVA' => [
				'type' => 'DATE',
				'null' => TRUE,
			],
			'CLASIFICACIONDOCTOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'AUTOR' => [
				'type' => 'INT',
				'constraint' => '5',
				'null' => TRUE,
			],
			'OFICINAIDAUTOR' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'STATUSDOCUMENTOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'PLANTILLAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'CALIFICACION' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'ESTADOACCESO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'M',
				'null' => TRUE,
			],
			'EMPLEADORESPONSABLE' => [
				'type' => 'INT',
				'constraint' => '5',
				'null' => TRUE,
			],
			'EXPAREAIDRESPONSABLE' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'EXPEMPIDRESPONSABLE' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'PUBLICADO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
				'null' => TRUE,
			],
			'RUTAALMACENAMIENTOID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'STATUSALMACENID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'EXPORTAR' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('FOLIODOCUMENTO');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIODOCUMENTO');
	}
}
