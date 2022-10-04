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
            'DENUNCIANTEID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
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
            'VICTIMANOMBRE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
            'VICTIMAEDAD' => [
				'type' => 'INT',
				'constraint' => '5',
				'null' => TRUE,
			],
            'VICTIMATELEFONO' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE,
			],
            'VICTIMADOMICILIO' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => TRUE,
			],
            'RELACIONDELITO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
            'IMPUTADONOMBRE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
            'IMPUTADOEDAD' => [
				'type' => 'INT',
				'constraint' => '5',
				'null' => TRUE,
			],
            'HECHO' => [
				'type' => 'TEXT',
				'null' => TRUE,
			],
            'NUMDELITO' => [
				'type' => 'INT',
				'constraint' => '5',
				'null' => TRUE,
			],
            'ZONASEJAP' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
            //
			'TIPODOC' => [
				'type' => 'TEXT',
				'null' => TRUE,
			],
            'PLACEHOLDER' => [
				'type' => 'TEXT',
				'null' => TRUE,
			],

            //DATOS FIRMA
            'OFICINAID' => [
				'type' => 'INT',
				'constraint' => '5',
				'null' => TRUE,
			],
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
			'STATUS' => [
				'type' => 'VARCHAR',
				'constraint' => '15',
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
