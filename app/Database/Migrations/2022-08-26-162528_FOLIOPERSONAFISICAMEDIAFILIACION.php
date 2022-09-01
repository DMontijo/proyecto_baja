<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOPERSONAFISICAMEDIAFILIACION extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'FOLIOID' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'PERSONAFISICAID' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'ANO' => [
                'type' => 'INT',
                'constraint' => '4',
            ],
            'OCUPACIONID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'ESTATURA' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'PESO' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'SENASPARTICULARES' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'PIELCOLORID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'FIGURAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CONTEXTURAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CARAFORMAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CARATAMANOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CARATEZID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'OREJALOBULOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'OREJAFORMAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'OREJATAMANOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CABELLOCOLORID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CABELLOESTILOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CABELLOTAMANOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CABELLOPECULIARID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CABELLODESCR' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'FRENTEALTURAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'FRENTEANCHURAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'FRENTEFORMAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'FRENTEPECULIARID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CEJACOLOCACIONID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CEJAFORMAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CEJATAMANOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CEJAGROSORID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'OJOCOLOCACIONID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'OJOFORMAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'OJOTAMANOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'OJOCOLORID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'OJOPECULIARID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'NARIZTIPOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'NARIZTAMANOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'NARIZBASEID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'NARIZPECULIARID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'NARIZDESCR' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'null' => true,
            ],
            'BIGOTEFORMAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'BIGOTETAMANOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'BIGOTEGROSORID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'BIGOTEPECULIARID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'BIGOTEDESCR' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'null' => true,
            ],
            'BOCATAMANOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'BOCAPECULIARID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'LABIOGROSORID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'LABIOLONGITUDID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'LABIOPOSICIONID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'LABIOPECULIARID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'DIENTETAMANOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'DIENTETIPOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'DIENTEPECULIARID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'DIENTEDESCR' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'BARBILLAFORMAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'BARBILLATAMANOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'BARBILLAINCLINACIONID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'BARBILLAPECULIARID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'BARBILLADESCR' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'BARBATAMANOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'BARBAPECULIARID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'BARBADESCR' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'CUELLOTAMANOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CUELLOGROSORID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CUELLOPECULIARID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'CUELLODESCR' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'HOMBROPOSICIONID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'HOMBROLONGITUDID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'HOMBROGROSORID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'ESTOMAGOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'PERSONAESCOLARIDADID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'PERSONAETNIAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'ESTOMAGODESCR' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'DISCAPACIDADDESCR' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'FECHADESAPARICION' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'LUGARDESAPARICION' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'VESTIMENTADESCR' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
            'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('FOLIOID', true);
        $this->forge->addKey('PERSONAFISICAID', true);
        $this->forge->addKey('ANO', true);

        // $this->forge->addForeignKey('OCUPACIONID', 'OCUPACION', 'PERSONAOCUPACIONID');
        // $this->forge->addForeignKey('PIELCOLORID', 'PIELCOLOR', 'PIELCOLORID');
        // $this->forge->addForeignKey('FIGURAID', 'FIGURA', 'FIGURAID');
        // $this->forge->addForeignKey('CONTEXTURAID', 'CEJACONTEXTURA', 'CONTEXTURAID');
        // $this->forge->addForeignKey('CARAFORMAID', 'CARAFORMA', 'CARAFORMAID');
        // $this->forge->addForeignKey('CARATAMANOID', 'CARATAMANO', 'CARATAMANOID');
        // $this->forge->addForeignKey('CARATEZID', 'CARATEZ', 'CARATEZID');
        // $this->forge->addForeignKey('OREJALOBULOID', 'OREJALOBULO', 'OREJALOBULOID');
        // $this->forge->addForeignKey('OREJAFORMAID', 'OREJAFORMA', 'OREJAFORMAID');
        // $this->forge->addForeignKey('OREJATAMANOID', 'OREJATAMANO', 'OREJATAMANOID');
        // $this->forge->addForeignKey('CABELLOCOLORID', 'CABELLOCOLOR', 'CABELLOCOLORID');
        // $this->forge->addForeignKey('CABELLOESTILOID', 'CABELLOESTILO', 'CABELLOESTILOID');
        // $this->forge->addForeignKey('CABELLOTAMANOID', 'CABELLOTAMANO', 'CABELLOTAMANOID');
        // $this->forge->addForeignKey('CABELLOPECULIARID', 'CABELLOPECULIAR', 'CABELLOPECULIARID');
        // $this->forge->addForeignKey('FRENTEALTURAID', 'FRENTEALTURA', 'FRENTEALTURAID');
        // $this->forge->addForeignKey('FRENTEANCHURAID', 'FRENTEANCHURA', 'FRENTEANCHURAID');
        // $this->forge->addForeignKey('FRENTEFORMAID', 'FRENTEFORMA', 'FRENTEFORMAID');
        // $this->forge->addForeignKey('FRENTEPECULIARID', 'FRENTEPECULIAR', 'FRENTEPECULIARID');
        // $this->forge->addForeignKey('CEJACOLOCACIONID', 'CEJACOLOCACION', 'CEJACOLOCACIONID');
        // $this->forge->addForeignKey('CEJAFORMAID', 'CEJAFORMA', 'CEJAFORMAID');
        // $this->forge->addForeignKey('CEJATAMANOID', 'CEJATAMANO', 'CEJATAMANOID');
        // $this->forge->addForeignKey('CEJAGROSORID', 'CEJAGROSOR', 'CEJAGROSORID');
        // $this->forge->addForeignKey('OJOCOLOCACIONID', 'OJOCOLOCACION', 'OJOCOLOCACIONID');
        // $this->forge->addForeignKey('OJOFORMAID', 'OJOFORMA', 'OJOFORMAID');
        // $this->forge->addForeignKey('OJOTAMANOID', 'OJOTAMANO', 'OJOTAMANOID');
        // $this->forge->addForeignKey('OJOCOLORID', 'OJOCOLOR', 'OJOCOLORID');
        // $this->forge->addForeignKey('OJOPECULIARID', 'OJOPECULIAR', 'OJOPECULIARID');
        // $this->forge->addForeignKey('NARIZTIPOID', 'NARIZTIPO', 'NARIZTIPOID');
        // $this->forge->addForeignKey('NARIZTAMANOID', 'NARIZTAMANO', 'NARIZTAMANOID');
        // $this->forge->addForeignKey('NARIZBASEID', 'NARIZBASE', 'NARIZBASEID');
        // $this->forge->addForeignKey('NARIZPECULIARID', 'NARIZPECULIAR', 'NARIZPECULIARID');
        // $this->forge->addForeignKey('BIGOTEFORMAID', 'BIGOTEFORMA', 'BIGOTEFORMAID');
        // $this->forge->addForeignKey('BIGOTETAMANOID', 'BIGOTETAMANO', 'BIGOTETAMANOID');
        // $this->forge->addForeignKey('BIGOTEGROSORID', 'BIGOTEGROSOR', 'BIGOTEGROSORID');
        // $this->forge->addForeignKey('BIGOTEPECULIARID', 'BIGOTEPECULIAR', 'BIGOTEPECULIARID');
        // $this->forge->addForeignKey('BOCATAMANOID', 'BOCATAMANO', 'BOCATAMANOID');
        // $this->forge->addForeignKey('BOCAPECULIARID', 'BOCAPECULIAR', 'BOCAPECULIARID');
        // $this->forge->addForeignKey('LABIOGROSORID', 'LABIOGROSOR', 'LABIOGROSORID');
        // $this->forge->addForeignKey('LABIOLONGITUDID', 'LABIOLONGITUD', 'LABIOLONGITUDID');
        // $this->forge->addForeignKey('LABIOPOSICIONID', 'LABIOPOSICION', 'LABIOPOSICIONID');
        // $this->forge->addForeignKey('LABIOPECULIARID', 'LABIOPECULIAR', 'LABIOPECULIARID');
        // $this->forge->addForeignKey('DIENTETAMANOID', 'DIENTETAMANO', 'DIENTETAMANOID');
        // $this->forge->addForeignKey('DIENTETIPOID', 'DIENTETIPO', 'DIENTETIPOID');
        // $this->forge->addForeignKey('DIENTEPECULIARID', 'DIENTEPECULIAR', 'DIENTEPECULIARID');
        // $this->forge->addForeignKey('BARBILLAFORMAID', 'BARBILLAFORMA', 'BARBILLAFORMAID');
        // $this->forge->addForeignKey('BARBILLATAMANOID', 'BARBILLATAMANO', 'BARBILLATAMANOID');
        // $this->forge->addForeignKey('BARBILLAINCLINACIONID', 'BARBILLAINCLINACION', 'BARBILLAINCLINACIONID');
        // $this->forge->addForeignKey('BARBILLAPECULIARID', 'BARBILLAPECULIAR', 'BARBILLAPECULIARID');
        // $this->forge->addForeignKey('BARBATAMANOID', 'BARBATAMANO', 'BARBATAMANOID');
        // $this->forge->addForeignKey('BARBAPECULIARID', 'BARBAPECULIAR', 'BARBAPECULIARID');
        // $this->forge->addForeignKey('CUELLOTAMANOID', 'CUELLOTAMANO', 'CUELLOTAMANOID');
        // $this->forge->addForeignKey('CUELLOGROSORID', 'CUELLOGROSOR', 'CUELLOGROSORID');
        // $this->forge->addForeignKey('CUELLOPECULIARID', 'CUELLOPECULIAR', 'CUELLOPECULIARID');
        // $this->forge->addForeignKey('HOMBROPOSICIONID', 'HOMBROPOSICION', 'HOMBROPOSICIONID');
        // $this->forge->addForeignKey('HOMBROLONGITUDID', 'HOMBROLONGITUD', 'HOMBROLONGITUDID');
        // $this->forge->addForeignKey('HOMBROGROSORID', 'HOMBROGROSOR', 'HOMBROGROSORID');
        // $this->forge->addForeignKey('ESTOMAGOID', 'ESTOMAGO', 'ESTOMAGOID');
        // $this->forge->addForeignKey('PERSONAESCOLARIDADID', 'ESCOLARIDAD', 'PERSONAESCOLARIDADID');
        // $this->forge->addForeignKey('PERSONAETNIAID', 'PERSONAETNIA', 'PERSONAETNIAID');

        $this->forge->createTable('FOLIOPERSONAFISICAMEDIAFILIACION', true);
    }

    public function down()
    {
        $this->forge->dropTable('FOLIOPERSONAFISICAMEDIAFILIACION', true);
    }
}
