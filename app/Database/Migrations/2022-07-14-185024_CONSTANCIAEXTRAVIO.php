<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CONSTANCIAEXTRAVIO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'CONSTANCIAEXTRAVIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ANO' => [
				'type' => 'INT',
				'constraint' => '4',
			],
			'SOLICITANTEID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'MUNICIPIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'MUNICIPIOIDCITA' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'ESTADOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'EXTRAVIO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'DOMICILIO' => [
				'type' => 'TEXT',
				'constraint' => '300',
				'null' => TRUE,
			],
			'HECHOLUGARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'HECHOFECHA' => [
				'type' => 'DATE',
				'null' => TRUE,
			],
			'PLACEHOLDER' => [
				'type' => 'TEXT',
				'null' => TRUE,
			],
			'NBOLETO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'NTALON' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'NOMBRESORTEO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'SORTEOFECHA' => [
				'type' => 'DATE',
				'null' => TRUE,
			],
			'PERMISOGOBERNACION' => [
				'type' => 'TEXT',
				'constraint' => '300',
				'null' => TRUE,
			],
			'PERMISOGOBCOLABORADORES' => [
				'type' => 'TEXT',
				'constraint' => '300',
				'null' => TRUE,
			],
			'TIPODOCUMENTO' => [
				'type' => 'VARCHAR',
				'constraint' => '75',
				'null' => TRUE,
			],
			'NDOCUMENTO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'DUENONOMBREDOC' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'DUENOAPELLIDOPDOC' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'DUENOAPELLIDOMDOC' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'SERIEVEHICULO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'NPLACA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'POSICIONPLACA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'DISTRIBUIDORVEHICULO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'MARCA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'MODELO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'ANIOVEHICULO' => [
				'type' => 'INT',
				'constraint' => '4',
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
			'CADENAFIRMANDA' => [
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
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('CONSTANCIAEXTRAVIOID', TRUE);
		$this->forge->addKey('ANO', TRUE);
		$this->forge->createTable('CONSTANCIAEXTRAVIO');
	}

	public function down()
	{
		$this->forge->dropTable('CONSTANCIAEXTRAVIO');
	}
}
