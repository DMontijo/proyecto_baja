<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERSONAFISICAPARENTESCO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'FOLIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
            'ANO' => [
				'type' => 'INT',
				'constraint' => '4',
			],
            'PERSONAFISICAID1' => [
				'type' => 'INT',
				'constraint' => 200,
			],
            'PARENTESCOID' => [
				'type' => 'INT',
				'constraint' => 200,
			],
            'PERSONAFISICAID2' => [
				'type' => 'INT',
				'constraint' => 200,
			],
        ]);
        $this->forge->addKey('FOLIOID', TRUE);
		$this->forge->addKey('ANO', TRUE);
		$this->forge->addKey('PERSONAFISICAID1', TRUE);
		$this->forge->addKey('PARENTESCOID', TRUE);
		$this->forge->addKey('PERSONAFISICAID2', TRUE);

        $this->forge->createTable('FOLIORELACIONPARENTESCO', true);
    }

    public function down()
    {
        $this->forge->dropTable('FOLIORELACIONPARENTESCO', true);
    }
}
