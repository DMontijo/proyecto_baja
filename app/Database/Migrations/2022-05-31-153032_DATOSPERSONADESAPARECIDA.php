<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DATOSPERSONADESAPARECIDA extends Migration
{
    public function up()
	{

		$this->forge->addField([
			'ID_PERSONA_DESAPARECIDA' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
				'unique' => TRUE,
			],
			'NOMBRE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'APE_PATERNO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'APE_MATERNO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'ESTATURA' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'FECHA_NACIMIENTO' => [
				'type' => 'DATE',
				'null' => TRUE,
			],
            'EDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
            'PESO' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
            'COMPLEXION' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
            'COLOR_TEZ' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'SEXO' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
            'SENAS' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'IDENTIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'COLOR_CABELLO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'TAM_CABELLO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'FORMA_CABELLO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'COLOR_OJOS' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'FRENTE' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'CEJA' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'DISCAPACIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'ORIGEN' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'DIA_DESAPARICION' => [
				'type' => 'DATE',
				'null' => TRUE,
			],
            'LUGAR_DESAPARICION' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'VESTIMENTA' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'PARENTESCO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
            'FOTOGRAFIA' => [
				'type' => 'BLOB',

				'null' => TRUE,
			],
			'AUTORIZA_FOTO' => [
				'type' => 'TINYINT',
				'constraint' => '1',
				'null' => TRUE,
			],
            

			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID_PERSONA_DESAPARECIDA', TRUE);
		$this->forge->createTable('DATOS_PERSONA_DESAPARECIDA');
	}

	public function down()
	{
		$this->forge->dropTable('DATOS_PERSONA_DESAPARECIDA');
	}
}
