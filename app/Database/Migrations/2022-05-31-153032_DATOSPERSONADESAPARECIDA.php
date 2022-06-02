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
			],
			'APE_PATERNO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'APE_MATERNO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'ESTATURA' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'FECHA_NACIMIENTO' => [
				'type' => 'DATE',
			],
            'EDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
            'PESO' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
            'COMPLEXION' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
            'COLOR_TEZ' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'SEXO' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
            'SENAS' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'IDENTIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'COLOR_CABELLO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'TAM_CABELLO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'FORMA_CABELLO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'COLOR_OJOS' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'FRENTE' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'CEJA' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'DISCAPACIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'ORIGEN' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'DIA_DESAPARICION' => [
				'type' => 'DATE',
			],
            'LUGAR_DESAPARICION' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'VESTIMENTA' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'PARENTESCO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
            'FOTOGRAFIA' => [
				'type' => 'BLOB',

			],
			'AUTORIZA_FOTO' => [
				'type' => 'TINYINT',
				'constraint' => '1',
			],
            

			'CREADO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'ACTUALIZADO DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID_PERSONA_DESAPARECIDA', TRUE);
		$this->forge->createTable('DATOS_PERSONA_DESAPARECIDA');
	}

	public function down()
	{
		$this->forge->dropTable('DATOS_PERSONA_DESAPARECIDA');
	}
}
