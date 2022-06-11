<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOPERSONAFISIMP extends Migration
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
			'PERSONAFISICAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'default' => 2,
			],
			'DETENIDO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
			],
			'ESTADOJURIDICOIMPUTADOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'default' => 1,
			],
			'ETAPAIMPUTADOID' => [
				'type' => 'INT',
				'null' => TRUE,
				'default' => 1,
			],
			'INDIVIDUALIZADO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
			],
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('FOLIOPERSONAFISIMP');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOPERSONAFISIMP');
	}
}
