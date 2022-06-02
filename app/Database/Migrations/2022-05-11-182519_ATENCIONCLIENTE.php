<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ATENCIONCLIENTE extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'ID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'FOLIO'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
			],
			'FECHA_HORA'       => [
				'type'           => 'DATETIME',
				'null' => TRUE,
			],
			'IDMUNICIPIO'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'null' => TRUE,
			],
			'IDCIUDADANO'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'null' => TRUE,
			],
			'IDEXPEDIENTE'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'null' => TRUE,
			],
			'IDDERIVACION'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'null' => TRUE,
			],
			'IDAGENTE'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'null' => TRUE,
			],
			'ID_DENUNCIA'       => [
				'type'           => 'INT',
				'null' => TRUE,
			],
			'ID_DATOS_DELITO'       => [
				'type'           => 'INT',
				'null' => TRUE,
			],
			'ID_DATOS_DEL_RESPONSABLE'       => [
				'type'           => 'INT',
				'null' => TRUE,
			],
			'ID_DATOS_ADULTO_ACOMPANANTE'       => [
				'type'           => 'INT',
				'null' => TRUE,
			],
			'ID_DATOS_MENOR_EDAD'       => [
				'type'           => 'INT',
				'null' => TRUE,
			],
			'ID_DATOS_PERSONA_DESAPARECIDA'       => [
				'type'           => 'INT',
				'null' => TRUE,
			],
			'ID_DATOS_ROBO_VEHICULO'       => [
				'type'           => 'INT',
				'null' => TRUE,
			],
			'ID_MODULO_SEJAP'       => [
				'type'           => 'INT',
				'null' => TRUE,
			],
			'NOTAS'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '200',
				'null' => TRUE,
			],
			'CREADO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'ACTUALIZADO DATETIME ON UPDATE CURRENT_TIMESTAMP',

		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('ATENCION_CLIENTE');
	}

	public function down()
	{
		$this->forge->dropTable('ATENCION_CLIENTE');
	}
}
