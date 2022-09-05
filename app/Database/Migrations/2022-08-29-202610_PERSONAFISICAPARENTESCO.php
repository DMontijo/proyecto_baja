<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERSONAFISICAPARENTESCO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'IDRELACION'=>[
                'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
            ],
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
        $this->forge->addKey('IDRELACION', TRUE);
        $this->forge->addKey('FOLIOID', TRUE);
		$this->forge->addKey('ANO', TRUE);

        $this->forge->createTable('FOLIORELACIONPARENTESCO', true);
    }

    public function down()
    {
        $this->forge->dropTable('FOLIORELACIONPARENTESCO', true);
    }
}
