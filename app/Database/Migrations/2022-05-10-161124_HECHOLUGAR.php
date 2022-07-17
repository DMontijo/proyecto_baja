<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HECHOLUGAR extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'HECHOLUGARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'HECHODESCR' => [
				'type' => 'TEXT',
				'constraint' => '300',
			],
		]);
		$this->forge->addKey('HECHOLUGARID', TRUE);
		$this->forge->createTable('HECHOLUGAR');
	}

	public function down()
	{
		$this->forge->dropTable('HECHOLUGAR');
	}
}
