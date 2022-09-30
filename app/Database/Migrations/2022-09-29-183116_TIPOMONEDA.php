<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIPOMONEDA extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'TIPOMONEDAID' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'TIPOMONEDADESCR' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('TIPOMONEDAID', true);
        $this->forge->addKey('OBJETOID', true);
    
        $this->forge->createTable('TIPOMONEDA');
        }
    
    public function down()
    {
        $this->forge->dropTable('TIPOMONEDA');
    
    }
    }
