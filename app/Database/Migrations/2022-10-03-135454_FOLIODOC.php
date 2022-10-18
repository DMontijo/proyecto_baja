<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIODOC extends Migration
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
           
            'ESTADOID' => [ //DONDE SE FIRMA
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
            'MUNICIPIOID' => [ //DONDE SE FIRMA
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
            'NUMEROEXPEDIENTE' => [
				'type' => 'VARCHAR',
				'constraint' => '16',
				'null' => TRUE,
			],
           
			'TIPODOC' => [
				'type' => 'TEXT',
				'null' => TRUE,
			],
            'PLACEHOLDER' => [
				'type' => 'TEXT',
				'null' => TRUE,
			],

            //DATOS FIRMA
            
            'AGENTEID' => [
				'type' => 'INT',
				'constraint' => '5',
				'null' => TRUE,
			],
			'NUMEROIDENTIFICADOR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'RAZONSOCIALFIRMA' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE,
			],
			'RFCFIRMA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
            'NCERTIFICADOFIRMA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
            'FECHAFIRMA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
            'HORAFIRMA' => [
				'type' => 'TIME',
				'null' => TRUE,
			],
			'LUGARFIRMA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'CADENAFIRMADA' => [
				'type' => 'TEXT',
				'null' => TRUE,
			],
			'FIRMAELECTRONICA' => [
				'type' => 'LONGBLOB',
				'null' => TRUE,
			],
			'PDF' => [
				'type' => 'LONGBLOB',
				'null' => TRUE,
			],
			'XML' => [
				'type' => 'LONGBLOB',
				'null' => TRUE,
			],
			'STATUS' => [
				'type' => 'VARCHAR',
				'constraint' => '15',
				'null' => TRUE,
			],
			'STATUSENVIO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'ENVIADO'=>[
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',

        ]);
		$this->forge->addKey('FOLIOID', TRUE);
        $this->forge->addKey('FOLIODOCID', TRUE);
		$this->forge->addKey('ANO', TRUE);
		$this->forge->createTable('FOLIODOC');
	
    }

    public function down()
    {
        $this->forge->dropTable('FOLIODOC');

    }
}
