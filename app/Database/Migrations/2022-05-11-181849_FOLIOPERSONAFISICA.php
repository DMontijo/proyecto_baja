<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOPERSONAFISICA extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'FOLIOID' => [
				'type' => 'VARCHAR',
				'constraint' => '16',
			],
			'PERSONAFISICAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CALIDADJURIDICAID' => [
				'type' => 'INT',
			],
			'RESERVARIDENTIDAD' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
			],
			'DENUNCIANTE' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
			],
			'VIVA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'S',
			],
			'TIPOIDENTIFICACIONID' => [
				'type' => 'INT',
			],
			'NUMEROIDENTIFICACION' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE,
			],
			'NOMBRE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'PRIMERAPELLIDO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'SEGUNDOAPELLIDO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'NUMEROIDENTIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '30',
				'null' => TRUE,
			],
			'ESTADOORIGENID' => [
				'type' => 'INT',
			],
			'MUNICIPIOORIGENID' => [
				'type' => 'INT',
			],
			'FECHANACIMIENTO' => [
				'type' => 'DATE',
			],
			'EDAD' => [
				'type' => 'INT',
				'constraint' => '3',
			],
			'SEXO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'TELEFONO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'CORREO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'EDADCANTIDAD' => [
				'type' => 'INT',
				'constraint' => '5',
				'null' => TRUE,
			],
			'EDADTIEMPO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'NACIONALIDADID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ESTADOCIVILID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'APODO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'FOTO' => [
				'type' => 'BLOB',
				'constraint' => '30',
				'null' => TRUE,
			],
			'ESTADOJURIDICOIMPUTADOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'DESAPARECIDA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'PERSONATIPOMUERTEID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'PERSONARELIGIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'TIPOVIVIENDAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'LUGARFRECUENTA' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => TRUE,
			],
			'VESTUARIO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'AFECTOBEBIDA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'BEBIDAS' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'AFECTODROGA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'DROGAS' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
			'SOLICITANTEASESORIA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
			],
			'INGRESOS' => [
				'type' => 'DECIMAL(12,2)',
				'null' => TRUE,
			],
			'PERSONAIDIOMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'TIEMPORESIDEANOS' => [
				'type' => 'INT',
				'constraint' => '3',
				'null' => TRUE,
			],
			'TIEMPORESIDEMESES' => [
				'type' => 'INT',
				'constraint' => '3',
				'null' => TRUE,
			],
			'TIEMPORESIDEDIAS' => [
				'type' => 'INT',
				'constraint' => '3',
				'null' => TRUE,
			],
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('FOLIOPERSONAFISICA');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOPERSONAFISICA');
	}
}
