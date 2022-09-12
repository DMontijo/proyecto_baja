<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPEDIENTEOBJETO extends Migration
{
    public function up()
    {
    $this->forge->addField([
        'FOLIOID' => [
            'type' => 'INT',
            'unsigned' => true,
        ],
        'ANO' => [
            'type' => 'INT',
            'constraint' => '4',
        ],
        'OBJETOID' => [
            'type' => 'INT',
            'unsigned' => true,
        ],
        'SITUACION' => [
            'type' => 'CHAR',
            'constraint' => '1',
            'null' => true,
        ],
        'CLASIFICACIONID' => [
            'type' => 'INT',
            'unsigned' => true,
            'null' => true,
        ],
        'SUBCLASIFICACIONID' => [
            'type' => 'INT',
            'unsigned' => true,
            'null' => true,
        ],
        'MARCA' => [
            'type' => 'VARCHAR',
            'constraint' => '100',
            'null' => true,
        ],
        'NUMEROSERIE' => [
            'type' => 'VARCHAR',
            'constraint' => '100',
            'null' => true,
        ],
        'CANTIDAD' => [
            'type' => 'VARCHAR',
            'constraint' => '100',
            'null' => true,
        ],
        'VALOR' => [
            'type' => 'VARCHAR',
            'constraint' => '100',
            'null' => true,
        ],
        'TIPOMONEDAID' => [
            'type' => 'INT',
            'unsigned' => true,
        ],
        'DESCRIPCIONDETALLADA' => [
            'type' => 'VARCHAR',
            'constraint' => '100',
            'null' => true,
        ],
        'PERSONAFISICAIDPROPIETARIO' => [
            'type' => 'INT',
            'null' => true,
        ],
        'PERSONAMORALIDPROPIETARIO' => [
            'type' => 'INT',
            'null' => true,
        ],
        'FOTO' => [
            'type' => 'LONGBLOB',
            'null' => true,
        ],
        'PARTICIPAESTADO' => [
            'type' => 'CHAR',
            'constraint' => '1',
            'null' => true,
        ],
        'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',

       
    ]);
    $this->forge->addKey('FOLIOID', true);
    $this->forge->addKey('ANO', true);
    $this->forge->addKey('OBJETOID', true);

    $this->forge->createTable('EXPEDIENTEOBJETO');
    }

public function down()
{
    $this->forge->dropTable('EXPEDIENTEOBJETO');

}
}
