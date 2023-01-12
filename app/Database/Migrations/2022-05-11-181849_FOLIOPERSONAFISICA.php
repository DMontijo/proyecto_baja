<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOPERSONAFISICA extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'FOLIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERSONAFISICAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ANO' => [
				'type' => 'INT',
				'constraint' => '4',
			],
			'CALIDADJURIDICAID' => [
				'type' => 'INT',
				'constraint' => '5',
				'null' => TRUE,
			],
			'RESERVARIDENTIDAD' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
				'null' => TRUE,
			],
			'DENUNCIANTE' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
				'null' => TRUE,
			],
			'VIVA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'S',
				'null' => TRUE,
			],
			'TIPOIDENTIFICACIONID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'NUMEROIDENTIFICACION' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE,
			],
			'APODO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
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
			'PAIS' => [
				'type' => 'CHAR',
				'constraint' => '2',
				'null' => TRUE,
			],
			'ESTADOORIGENID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'MUNICIPIOORIGENID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'FECHANACIMIENTO' => [
				'type' => 'DATE',
				'null' => TRUE,
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
			'TELEFONO2' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'CODIGOPAISTEL' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'CODIGOPAISTEL2' => [
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
			'NACIONALIDADID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'ESTADOCIVILID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'FOTO' => [
				'type' => 'LONGBLOB',
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
				'default' => 'N',
				'null' => TRUE,
			],
			'PERSONATIPOMUERTEID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'PERSONARELIGIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'TIPOVIVIENDAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
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
			'SOLICITANTEASESORIA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
				'null' => TRUE,
			],
			'INGRESOS' => [
				'type' => 'DECIMAL(12,2)',
				'null' => TRUE,
			],
			'PERSONAIDIOMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
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
			'ESCOLARIDADID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'OCUPACIONID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'OCUPACIONDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'DESCRIPCION_FISICA' => [
				'type' => 'VARCHAR',
				'constraint' => '300',
				'null' => TRUE,
			],
			'FACEBOOK' => [
				'type' => 'VARCHAR',
				'constraint' => '250',
				'null' => TRUE
			],
			'INSTAGRAM' => [
				'type' => 'VARCHAR',
				'constraint' => '250',
				'null' => TRUE
			],
			'TWITTER' => [
				'type' => 'VARCHAR',
				'constraint' => '250',
				'null' => TRUE
			],
			'LEER' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'S',
			],
			'ESCRIBIR' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'S',
			],
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('FOLIOID', TRUE);
		$this->forge->addKey('PERSONAFISICAID', TRUE);
		$this->forge->addKey('ANO', TRUE);
		$this->forge->createTable('FOLIOPERSONAFISICA');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOPERSONAFISICA');
	}
}
