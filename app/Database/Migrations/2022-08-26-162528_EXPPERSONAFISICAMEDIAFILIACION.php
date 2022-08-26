<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPPERSONAFISICAMEDIAFILIACION extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'FOLIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'EXPEDIENTEID' => [
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
			'OCUPACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ESTATURA' => [
				'type' => 'FLOAT',
				'unsigned' => TRUE,
			],
			'PESO' => [
				'type' => 'FLOAT',
				'unsigned' => TRUE,
			],
			'SENASPARTICULARES' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			'PIELCOLORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'FIGURAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CONTEXTURAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CARAFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CARATAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CARATEZID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'OREJALOBULOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'OREJAFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'OREJATAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CABELLOCOLORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CABELLOESTILOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CABELLOTAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CABELLOPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CABELLODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			'FRENTEALTURAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'FRENTEANCHURAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'FRENTEFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'FRENTEPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CEJACOLOCACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CEJAFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CEJATAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CEJAGROSORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'OJOCOLOCACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'OJOFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'OJOTAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'OJOCOLORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'OJOPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'NARIZTIPOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'NARIZTAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'NARIZBASEID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'NARIZPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'NARIZDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			'BIGOTEFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'BIGOTETAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'BIGOTEGROSORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'BIGOTEPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'BIGOTEDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			'BOCATAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'BOCAPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'LABIOGROSORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'LABIOLONGITUDID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'LABIOPOSICIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'LABIOPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'DIENTETAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'DIENTETIPOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'DIENTEPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'DIENTEDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			'BARBILLAFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'BARBILLATAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'BARBILLAINCLINACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'BARBILLAPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'BARBILLADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			'BARBATAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'BARBAPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'BARBADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			'CUELLOTAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CUELLOGROSORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CUELLOPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CUELLODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			'HOMBROPOSICIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'HOMBROLONGITUDID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'HOMBROGROSORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ESTOMAGOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERSONAESCOLARIDADID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERSONAETNIAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ESTOMAGODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
		]);
		$this->forge->addKey('FOLIOID', TRUE);
		$this->forge->addKey('PERSONAFISICAID', TRUE);
		$this->forge->addKey('ANO', TRUE);
		// $this->forge->addKey('EXPPERSONAFISICAMEDIAAFILIACIONID', true);
		// $this->forge->addForeignKey('PERSONAFISICAID', 'FOLIOPERSONAFISICA', 'PERSONAFISICAID');
		$this->forge->addForeignKey('OCUPACIONID', 'OCUPACION', 'PERSONAOCUPACIONID');
		$this->forge->addForeignKey('PIELCOLORID', 'PIELCOLOR', 'PIELCOLORID');
		$this->forge->addForeignKey('FIGURAID', 'FIGURA', 'FIGURAID');
		$this->forge->addForeignKey('CONTEXTURAID', 'CEJACONTEXTURA', 'CONTEXTURAID');
		$this->forge->addForeignKey('CARAFORMAID', 'CARAFORMA', 'CARAFORMAID');
		$this->forge->addForeignKey('CARATAMANOID', 'CARATAMANO', 'CARATAMANOID');
		$this->forge->addForeignKey('CARATEZID', 'CARATEZ', 'CARATEZID');
		$this->forge->addForeignKey('OREJALOBULOID', 'OREJALOBULO', 'OREJALOBULOID');
		$this->forge->addForeignKey('OREJAFORMAID', 'OREJAFORMA', 'OREJAFORMAID');
		$this->forge->addForeignKey('OREJATAMANOID', 'OREJATAMANO', 'OREJATAMANOID');
		$this->forge->addForeignKey('CABELLOCOLORID', 'CABELLOCOLOR', 'CABELLOCOLORID');
		$this->forge->addForeignKey('CABELLOESTILOID', 'CABELLOESTILO', 'CABELLOESTILOID');
		$this->forge->addForeignKey('CABELLOTAMANOID', 'CABELLOTAMANO', 'CABELLOTAMANOID');
		$this->forge->addForeignKey('CABELLOPECULIARID', 'CABELLOPECULIAR', 'CABELLOPECULIARID');
		$this->forge->addForeignKey('FRENTEALTURAID', 'FRENTEALTURA', 'FRENTEALTURAID');
		$this->forge->addForeignKey('FRENTEANCHURAID', 'FRENTEANCHURA', 'FRENTEANCHURAID');
		$this->forge->addForeignKey('FRENTEFORMAID', 'FRENTEFORMA', 'FRENTEFORMAID');
		$this->forge->addForeignKey('FRENTEPECULIARID', 'FRENTEPECULIAR', 'FRENTEPECULIARID');
		$this->forge->addForeignKey('CEJACOLOCACIONID', 'CEJACOLOCACION', 'CEJACOLOCACIONID');
		$this->forge->addForeignKey('CEJAFORMAID', 'CEJAFORMA', 'CEJAFORMAID');
		$this->forge->addForeignKey('CEJATAMANOID', 'CEJATAMANO', 'CEJATAMANOID');
		$this->forge->addForeignKey('CEJAGROSORID', 'CEJAGROSOR', 'CEJAGROSORID');
		$this->forge->addForeignKey('OJOCOLOCACIONID', 'OJOCOLOCACION', 'OJOCOLOCACIONID');
		$this->forge->addForeignKey('OJOFORMAID', 'OJOFORMA', 'OJOFORMAID');
		$this->forge->addForeignKey('OJOTAMANOID', 'OJOTAMANO', 'OJOTAMANOID');
		$this->forge->addForeignKey('OJOCOLORID', 'OJOCOLOR', 'OJOCOLORID');
		$this->forge->addForeignKey('OJOPECULIARID', 'OJOPECULIAR', 'OJOPECULIARID');
		$this->forge->addForeignKey('NARIZTIPOID', 'NARIZTIPO', 'NARIZTIPOID');
		$this->forge->addForeignKey('NARIZTAMANOID', 'NARIZTAMANO', 'NARIZTAMANOID');
		$this->forge->addForeignKey('NARIZBASEID', 'NARIZBASE', 'NARIZBASEID');
		$this->forge->addForeignKey('NARIZPECULIARID', 'NARIZPECULIAR', 'NARIZPECULIARID');
		$this->forge->addForeignKey('BIGOTEFORMAID', 'BIGOTEFORMA', 'BIGOTEFORMAID');
		$this->forge->addForeignKey('BIGOTETAMANOID', 'BIGOTETAMANO', 'BIGOTETAMANOID');
		$this->forge->addForeignKey('BIGOTEGROSORID', 'BIGOTEGROSOR', 'BIGOTEGROSORID');
		$this->forge->addForeignKey('BIGOTEPECULIARID', 'BIGOTEPECULIAR', 'BIGOTEPECULIARID');
		$this->forge->addForeignKey('BOCATAMANOID', 'BOCATAMANO', 'BOCATAMANOID');
		$this->forge->addForeignKey('BOCAPECULIARID', 'BOCAPECULIAR', 'BOCAPECULIARID');
		$this->forge->addForeignKey('LABIOGROSORID', 'LABIOGROSOR', 'LABIOGROSORID');
		$this->forge->addForeignKey('LABIOLONGITUDID', 'LABIOLONGITUD', 'LABIOLONGITUDID');
		$this->forge->addForeignKey('LABIOPOSICIONID', 'LABIOPOSICION', 'LABIOPOSICIONID');
		$this->forge->addForeignKey('LABIOPECULIARID', 'LABIOPECULIAR', 'LABIOPECULIARID');
		$this->forge->addForeignKey('DIENTETAMANOID', 'DIENTETAMANO', 'DIENTETAMANOID');
		$this->forge->addForeignKey('DIENTETIPOID', 'DIENTETIPO', 'DIENTETIPOID');
		$this->forge->addForeignKey('DIENTEPECULIARID', 'DIENTEPECULIAR', 'DIENTEPECULIARID');
		$this->forge->addForeignKey('BARBILLAFORMAID', 'BARBILLAFORMA', 'BARBILLAFORMAID');
		$this->forge->addForeignKey('BARBILLATAMANOID', 'BARBILLATAMANO', 'BARBILLATAMANOID');
		$this->forge->addForeignKey('BARBILLAINCLINACIONID', 'BARBILLAINCLINACION', 'BARBILLAINCLINACIONID');
		$this->forge->addForeignKey('BARBILLAPECULIARID', 'BARBILLAPECULIAR', 'BARBILLAPECULIARID');
		$this->forge->addForeignKey('BARBATAMANOID', 'BARBATAMANO', 'BARBATAMANOID');
		$this->forge->addForeignKey('BARBAPECULIARID', 'BARBAPECULIAR', 'BARBAPECULIARID');
		$this->forge->addForeignKey('CUELLOTAMANOID', 'CUELLOTAMANO', 'CUELLOTAMANOID');
		$this->forge->addForeignKey('CUELLOGROSORID', 'CUELLOGROSOR', 'CUELLOGROSORID');
		$this->forge->addForeignKey('CUELLOPECULIARID', 'CUELLOPECULIAR', 'CUELLOPECULIARID');
		$this->forge->addForeignKey('HOMBROPOSICIONID', 'HOMBROPOSICION', 'HOMBROPOSICIONID');
		$this->forge->addForeignKey('HOMBROLONGITUDID', 'HOMBROLONGITUD', 'HOMBROLONGITUDID');
		$this->forge->addForeignKey('HOMBROGROSORID', 'HOMBROGROSOR', 'HOMBROGROSORID');
		$this->forge->addForeignKey('ESTOMAGOID', 'ESTOMAGO', 'ESTOMAGOID');
		$this->forge->addForeignKey('PERSONAESCOLARIDADID', 'ESCOLARIDAD', 'PERSONAESCOLARIDADID');
		$this->forge->addForeignKey('PERSONAETNIAID', 'PERSONAETNIA', 'PERSONAETNIAID');

        $this->forge->createTable('EXPPERSONAFISICAMEDIAFILIACION', true);

	}

	public function down()
	{
		$this->forge->dropTable('EXPPERSONAFISICAMEDIAFILIACION', true);
	}
}
