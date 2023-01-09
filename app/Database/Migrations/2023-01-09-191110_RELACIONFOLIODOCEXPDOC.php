<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RELACIONFOLIODOCEXPDOC extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'FOLIODOCID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'FOLIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ANO' => [
				'type' => 'INT',
				'constraint' => '4',
			],
            'EXPEDIENTEID' => [
				'type' => 'VARCHAR',
                'constraint' => '20',
			],
			'EXPEDIENTEDOCID' => [
				'type' => 'INT',
				'constraint' => '10',
			],
        ]);
        $this->forge->addKey('FOLIOID', TRUE);
        $this->forge->addKey('FOLIODOCID', TRUE);
		$this->forge->addKey('ANO', TRUE);
        $this->forge->addKey('EXPEDIENTEID', TRUE);
        $this->forge->addKey('EXPEDIENTEDOCID', TRUE);
		$this->forge->createTable('RELACIONFOLIODOCEXPDOC');
    }

    public function down()
    {
        $this->forge->dropTable('RELACIONFOLIODOCEXPDOC');

    }
}
