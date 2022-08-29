<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PARENTESCO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'PERSONAPARENTESCOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
                
			],
            'PERSONAPARENTESCODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
        ]);
		$this->forge->addKey('PERSONAPARENTESCOID', TRUE);
        $this->forge->createTable('PERSONAPARENTESCO', true);


    }

    public function down()
    {
        $this->forge->dropTable('PERSONAPARENTESCO', true);

    }
}
