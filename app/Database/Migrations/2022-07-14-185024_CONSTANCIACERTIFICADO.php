<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CONSTANCIACERTIFICADO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'IDCERTIFICADOEXTRAVIADO' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'ANO' => [
				'type' => 'INT',
				'constraint' => '4',
			],
			'DENUNCIANTEID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'MUNICIPIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ESTADOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'EXTRAVIO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'DESCRIPCION_EXTRAVIO' => [
				'type' => 'TEXT',
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
			'HECHOHORA' => [
				'type' => 'TIME',
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
			'MARCAID' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'MODELOID' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'ANIOVEHICULO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'AGENTEID' => [
				'type' => 'INT',
				'constraint' => '5',
				'null' => TRUE,
			],
			'NUMERO_IDENTIFICADOR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'RFC_AGENTE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'NUMERO_CERTIFICADO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'FECHA_FIRMA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'HORA_FIRMA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'LUGAR_FIRMA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'FIRMA_ELECTRONICA' => [
				'type' => 'LONGBLOB',
				'null' => TRUE,
			],
			'TEXTO_CONSTANCIA' => [
				'type' => 'TEXT',
				'null' => TRUE,
			],
			'STATUS' => [
				'type' => 'VARCHAR',
				'constraint' => '15',
				'null' => TRUE,
			]
		]);
		$this->forge->addKey('IDCERTIFICADOEXTRAVIADO', TRUE);
		$this->forge->addKey('ANO', TRUE);
		$this->forge->createTable('CONSTANCIA_EXTRAVIO');
	}

	public function down()
	{
		$this->forge->dropTable('CONSTANCIA_EXTRAVIO');
	}
}
