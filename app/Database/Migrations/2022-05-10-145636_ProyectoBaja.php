<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProyectoBaja extends Migration
{
    public function up()
    {
        //TABLA CATEGORIA PERFILES
        $this->forge->addField([
            'IDCATPERFILES'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_PERFIL'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
        ]);
        $this->forge->addKey('IDCATPERFILES', TRUE);
        $this->forge->createTable('CATEGORIA_PERFILES');
        //TABLA PRIVILEGIOS

        $this->forge->addField([
            'IDPRIVILEGIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_PRIVILEGIO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'IDPERFIL'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
        ]);
        $this->forge->addKey('IDPRIVILEGIO', TRUE);
        $this->forge->addForeignKey('IDPERFIL', 'CATEGORIA_PERFILES', 'IDCATPERFILES');
        $this->forge->createTable('PRIVILEGIOS');
        //TABLA MUNICIPIOS

        $this->forge->addField([
            'IDMUNICIPIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_MUNICIPIO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'IDPERFIL'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
        ]);
        $this->forge->addKey('IDMUNICIPIO', TRUE);
        $this->forge->createTable('CATEGORIA_MUNICIPIO');
        //TABLA LOCALIDADES

        $this->forge->addField([
            'IDLOCALIDAD'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_LOCALIDAD'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ]
        ]);
        $this->forge->addKey('IDLOCALIDAD', TRUE);
        $this->forge->createTable('CATEGORIA_LOCALIDAD');
        //TABLA COLONIA

        $this->forge->addField([
            'IDCOLONIA'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_COLONIA'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ]
        ]);
        $this->forge->addKey('IDCOLONIA', TRUE);
        $this->forge->createTable('CATEGORIA_COLONIA');
        //TABLA DELITOS

        $this->forge->addField([
            'IDDELITO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_DELITO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
        ]);
        $this->forge->addKey('IDDELITO', TRUE);
        $this->forge->createTable('CATEGORIA_DELITOS');
        //TABLA SUBDELITOS

        $this->forge->addField([
            'IDSUBDELITO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_SUBDELITO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'IDDELITO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
        ]);
        $this->forge->addKey('IDDELITO', TRUE);
        $this->forge->addForeignKey('IDDELITO', 'CATEGORIA_DELITOS', 'IDDELITO');
        $this->forge->createTable('SUBCATEGORIA_DELITOS');
        $this->forge->createTable('CATEGORIA_DELITOS');
        //TABLA DERIVACION

        $this->forge->addField([
            'IDDERIVACION'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'IDATENCIONC'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDDEPDERIVACION'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
        ]);
        $this->forge->addKey('IDDELITO', TRUE);
        $this->forge->addForeignKey('IDDEPDERIVACION', 'CATEGORIA_DERIVACION', 'IDCATDERIVACION');
        $this->forge->createTable('DERIVACION');
        //TABLA CATALOGO DERIVACIONES

        $this->forge->addField([
            'IDCATDERIVACION'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_DEPARTAMENTO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'IDMUNICIPIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'IDLOCALIDAD'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'IDCOLONIA'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'CALLE_AVENIDA'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
            ],
            'NUM_EXTERIOR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
            ],
            'NUM_INTERIOR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null' => TRUE,
            ],
            'TELEFONO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '12',
            ],
            'CORREO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
        ]);
        $this->forge->addKey('IDCATDERIVACION', TRUE);
        $this->forge->addForeignKey('IDMUNICIPIO', 'CATEGORIA_MUNICIPIO', 'IDMUNICIPIO');
        $this->forge->addForeignKey('IDLOCALIDAD', 'CATEGORIA_LOCALIDAD', 'IDLOCALIDAD');
        $this->forge->addForeignKey('IDCOLONIA', 'CATEGORIA_COLONIA', 'IDCOLONIA');
        $this->forge->createTable('CATEGORIA_DERIVACION');
        //TABLA DENUNCIANTE

        $this->forge->addField([
            'IDDENUNCIANTE'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'APELLIDO_PATERNO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'APELLIDO_MATERNO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null' => TRUE,
            ],
            'FECHA_NACIMIENTO'       => [
                'type'           => 'DATE',
            ],
            'SEXO_BIOLOGICO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
            ],
            'IDMUNICIPIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'IDLOCALIDAD'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'IDCOLONIA'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'CALLE_AVENIDA'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
            ],
            'NUM_EXTERIOR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
            ],
            'NUM_INTERIOR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null' => TRUE,
            ],
            'TELEFONO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '12',
            ],
            'CORREO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'PASSWORD'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'TIPO_DOCUMENTO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'ARCHIVO_DOCUMENTO'       => [
                'type'           => 'TEXT',
            ],

        ]);
        $this->forge->addKey('IDDENUNCIANTE', TRUE);
        $this->forge->addForeignKey('IDMUNICIPIO', 'CATEGORIA_MUNICIPIO', 'IDMUNICIPIO');
        $this->forge->addForeignKey('IDLOCALIDAD', 'CATEGORIA_LOCALIDAD', 'IDLOCALIDAD');
        $this->forge->addForeignKey('IDCOLONIA', 'CATEGORIA_COLONIA', 'IDCOLONIA');
        $this->forge->createTable('DENUNCIANTE');
        //TABLA USUARIOS

        $this->forge->addField([
            'IDUSUARIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'APELLIDO_PATERNO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'APELLIDO_MATERNO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null' => TRUE,
            ],
            'SEXO_BIOLOGICO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
            ],
            'CORREO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'PASSWORD'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'HUELLA_DIGITAL'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'FIRMA_DIGITAL'       => [
                'type'           => 'TEXT',
            ],
            'IDPERFIL'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],

        ]);
        $this->forge->addKey('IDUSUARIO', TRUE);
        $this->forge->addForeignKey('IDPERFIL', 'CATEGORIA_PERFILES', 'IDCATPERFILES');
        $this->forge->createTable('USUARIOS');

        //TABLA DENUNCIA

        $this->forge->addField([
            'IDDENUNCIA'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'IDDELITO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDSUBDELITO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDMUNICIPIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDLOCALIDAD'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDCOLONIA'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'CALLE_AVENIDA'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
            ],
            'NUM_EXTERIOR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
            ],
            'NUM_INTERIOR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null' => TRUE,
            ],
            'LUGAR_DELITO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'CLASIFICACION_LUGAR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null' => TRUE,
            ],
            'FECHA_HORA'       => [
                'type'           => 'DATETIME',
            ],
            'DESC_OBJETOI'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
            ],
            'NARRACION'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
            ],
            'IDENTIFICACION_IMPUTADO'       => [
                'type'           => 'BOOLEAN',
                'null' => TRUE,
            ],
        ]);
        $this->forge->addKey('IDDENUNCIA', TRUE);
        $this->forge->addForeignKey('IDDELITO', 'CATEGORIA_DELITOS', 'IDDELITO');
        $this->forge->addForeignKey('IDSUBDELITO', 'SUBCATEGORIA_DELITOS', 'IDSUBDELITO');
        $this->forge->addForeignKey('IDMUNICIPIO', 'CATEGORIA_MUNICIPIO', 'IDMUNICIPIO');
        $this->forge->addForeignKey('IDLOCALIDAD', 'CATEGORIA_LOCALIDAD', 'IDLOCALIDAD');
        $this->forge->addForeignKey('IDCOLONIA', 'CATEGORIA_COLONIA', 'IDCOLONIA');
        $this->forge->createTable('DENUNCIANTE');


        //TABLA IMPUTADO

        $this->forge->addField([
            'IDIMPUTADO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'APELLIDO_PATERNO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'APELLIDO_MATERNO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null' => TRUE,
            ],
            'FECHA_NACIMIENTO'       => [
                'type'           => 'DATE',
                'null' => TRUE,
            ],
            'SEXO_BIOLOGICO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null' => TRUE,
            ],
            'IDMUNICIPIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null' => TRUE,
            ],
            'IDLOCALIDAD'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null' => TRUE,
            ],
            'IDCOLONIA'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null' => TRUE,
            ],
            'CALLE_AVENIDA'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
                'null' => TRUE,
            ],
            'NUM_EXTERIOR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null' => TRUE,
            ],
            'TELEFONO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '12',
                'null' => TRUE,
            ],
            'ESCOLARIDAD'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null' => TRUE,
            ],

        ]);
        $this->forge->addKey('IDIMPUTADO', TRUE);
        $this->forge->addForeignKey('IDMUNICIPIO', 'CATEGORIA_MUNICIPIO', 'IDMUNICIPIO');
        $this->forge->addForeignKey('IDLOCALIDAD', 'CATEGORIA_LOCALIDAD', 'IDLOCALIDAD');
        $this->forge->addForeignKey('IDCOLONIA', 'CATEGORIA_COLONIA', 'IDCOLONIA');
        $this->forge->createTable('IMPUTADO');
    }

    public function down()
    {
        $this->forge->dropTable('proyecto_baja');
    }
}
