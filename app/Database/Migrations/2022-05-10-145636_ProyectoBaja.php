<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProyectoBaja extends Migration
{
    public function up()
    {
       //TABLA CATEGORIA PERFILES
       $this->forge->addField([
        'IDESTADO'          => [
            'type'           => 'INT',
            'unsigned'       => TRUE,
            'auto_increment' => TRUE
        ],
        'NOMBRE_ESTADO'       => [
            'type'           => 'VARCHAR',
            'constraint'     => '100',
        ],
    ]);
    $this->forge->addKey('IDESTADO', TRUE);
    $this->forge->createTable('CATEGORIA_ESTADO');
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

        //TABLA EXPEDIENTE

        $this->forge->addField([
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'ESTADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ANO'          => [
                'type'           => 'INT',
                'constraint'     => '4',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CORRELATIVO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHAREGISTRO'          => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOMEDIOCONOCIMIENTOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOFECHA'          => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
            ],
            'HECHOLUGARID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOESTADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOMUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOLOCALIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHODELEGACIONID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOZONA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
            ],
            'HECHOCOLONIAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOCOLONIADESCR'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'HECHOCALLE'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'HECHONUMEROCASA'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'HECHONUMEROCASAINT'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'HECHOREFERENCIA'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '300',
                'null'=>TRUE,
            ],
            'HECHONARRACION'       => [
                'type'           => 'BLOB',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TIPOEXPEDIENTEID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTICIPAESTADO'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'default' => 'N',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'EMPLEADOIDREGISTRO'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'OFICINAIDRESPONSABLE'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CONFIDENCIAL'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'default' => 'N',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'ESTADOJURIDICOEXPEDIENTEID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'RELACIONDOCUMENTOS'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '500',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOCOORDENADAX'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOCOORDENADAY'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTENUMERO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTEFECHA'       => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTEAUTORIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTEAREADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTEEMPLEADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXHORTONUMERO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXHORTOESTADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXHORTOMUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXHORTOOFICINAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'AREAIDREGISTRO'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'AREAIDRESPONSABLE'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'LOCALIZACIONPERSONA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CONCLUIDO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXHORTOAUTORIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOCLASIFICACIONLUGARID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOVIALIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],

        ]);
        $this->forge->addKey('EXPEDIENTEID', TRUE);
        $this->forge->addForeignKey('ESTADOID', 'CATEGORIA_ESTADO', 'IDESTADO');
        $this->forge->addForeignKey('MUNICIPIOID', 'CATEGORIA_MUNICIPIO', 'IDMUNICIPIO');
        $this->forge->addForeignKey('HECHOMEDIOCONOCIMIENTOID', '', '');
        $this->forge->addForeignKey('HECHOLUGARID', '', '');
        $this->forge->addForeignKey('HECHOESTADOID', '', '');
        $this->forge->addForeignKey('HECHOMUNICIPIOID', '', '');
        $this->forge->addForeignKey('HECHOLOCALIDADID', '', '');
        $this->forge->addForeignKey('HECHODELEGACIONID', '', '');
        $this->forge->addForeignKey('HECHOCOLONIAID', '', '');
        $this->forge->addForeignKey('TIPOEXPEDIENTEID', '', '');
        $this->forge->addForeignKey('EMPLEADOIDREGISTRO', '', '');
        $this->forge->addForeignKey('OFICINAIDRESPONSABLE', '', '');
        $this->forge->addForeignKey('ESTADOJURIDICOEXPEDIENTEID', '', '');
        $this->forge->addForeignKey('PARTEAUTORIDADID', '', '');
        $this->forge->addForeignKey('PARTEAREADOID', '', '');
        $this->forge->addForeignKey('PARTEEMPLEADOID', '', '');
        $this->forge->addForeignKey('EXHORTOESTADOID', '', '');
        $this->forge->addForeignKey('EXHORTOMUNICIPIOID', '', '');
        $this->forge->addForeignKey('EXHORTOOFICINAID', '', '');
        $this->forge->addForeignKey('AREAIDREGISTRO', '', '');
        $this->forge->addForeignKey('AREAIDRESPONSABLE', '', '');
        $this->forge->addForeignKey('EXHORTOAUTORIDADID', '', '');
        $this->forge->addForeignKey('HECHOCLASIFICACIONLUGARID', '', '');
        $this->forge->addForeignKey('HECHOVIALIDADID', '', '');
        $this->forge->createTable('EXPEDIENTE');
    
        //TABLA EXPEDIENTE PERSONA FISICA

        $this->forge->addField([
            'EXPEDIENTEPFID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'PERSONAFISICAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'CALIDADJURIDICAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'RESERVARIDENTIDAD'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'DENUNCIANTE'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'VIVA'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'S',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TIPOIDENTIFICACIONID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'NUMEROIDENTIFICACION'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '20',
                'null'=>TRUE,
            ],
            'NOMBRE'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'PRIMERAPELLIDO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '50',
                'null'=>TRUE,
            ],
            'SEGUNDOAPELLIDO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '50',
                'null'=>TRUE,
            ],
            'NUMEROIDENTIDAD'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '30',
                'null'=>TRUE,
            ],
            'ESTADOORIGENID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MUNICIPIOORIGENID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHANACIMIENTO'          => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
            ],
            'SEXO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TELEFONO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'CORREO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'EDADCANTIDAD'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'constraint'     => '5',
                'null'=>TRUE,
            ],
            'EDADTIEMPO'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'NACIONALIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'constraint'     => '5',
                'null'=>TRUE,
            ],
            'ESTADOCIVILID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'constraint'     => '5',
                'null'=>TRUE,
            ],
            'APODO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'FOTO'       => [
                'type'           => 'BLOB',
                'unsigned'       => TRUE,
                'constraint'     => '30',
                'null'=>TRUE,
            ],
            'ESTADOJURIDICOIMPUTADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOMUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'DESAPARECIDA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
            ],
            'PERSONATIPOMUERTEID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PERSONARELIGIONID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TIPOVIVIENDAID'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
            ],
            'LUGARFRECUENTA'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '200',
                'null'=>TRUE,
            ],
            'VESTUARIO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'AFECTOBEBIDA'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'BEBIDAS'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'AFECTODROGA'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'DROGAS'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'FECHAREGISTRO'       => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'SOLICITANTEASESORIA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' =>'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'INGRESOS'       => [
                'type'           => 'DECIMAL(12,2)',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PERSONAIDIOMAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TIEMPORESIDEANOS'       => [
                'type'           => 'int',
                'unsigned'       => TRUE,
                'constraint'     => '3',
                'null'=>TRUE,
            ],
            'TIEMPORESIDEMESES'       => [
                'type'           => 'int',
                'unsigned'       => TRUE,
                'constraint'     => '3',
                'null'=>TRUE,
            ],
            'TIEMPORESIDEDIAS'       => [
                'type'           => 'int',
                'unsigned'       => TRUE,
                'constraint'     => '3',
                'null'=>TRUE,
            ],
        ]);
        $this->forge->addKey('EXPEDIENTEPFID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', '', '');
        $this->forge->addForeignKey('PERSONAFISICAID', '', '');
        $this->forge->addForeignKey('CALIDADJURIDICAID', '', '');
        $this->forge->addForeignKey('TIPOIDENTIFICACIONID', '', '');
        $this->forge->addForeignKey('ESTADOORIGENID', '', '');
        $this->forge->addForeignKey('MUNICIPIOORIGENID', '', '');
        $this->forge->addForeignKey('NACIONALIDADID', '', '');
        $this->forge->addForeignKey('ESTADOCIVILID', '', '');
        $this->forge->addForeignKey('ESTADOJURIDICOIMPUTADOID', '', '');
        $this->forge->addForeignKey('PERSONATIPOMUERTEID', '', '');
        $this->forge->addForeignKey('PERSONARELIGIONID', '', '');
        $this->forge->addForeignKey('TIPOVIVIENDAID', '', '');
        $this->forge->createTable('EXPEDIENTEPERSONAFISICA');
        
        //TABLA EXPEDIENTE PERSONA MORAL

        $this->forge->addField([
            'EXPEDIENTEPMID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'PERSONAMORALID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'CALIDADJURIDICAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'DENOMINACION'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '500',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ESTADOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'LOCALIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'DELEGACIONID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ZONA'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'COLONIAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'COLONIADESCR'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'CALLE'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'NUMERO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'NUMEROINTERIOR'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'REFERENCIA'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '300',
                'null'=>TRUE,
            ],
            'TELEFONO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'CORREO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'PERSONAMORALGIROID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PODERVOLUMEN'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '15',
                'null'=>TRUE,
            ],
           
            'PODERNONOTARIO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '15',
                'null'=>TRUE,
            ],
            'PODERNOPODER'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '15',
                'null'=>TRUE,
            ],
            'FECHAREGISTRO'          => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
            ],
        ]);
        $this->forge->addKey('EXPEDIENTEPMID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', '', '');
        $this->forge->addForeignKey('PERSONAMORALID', '', '');
        $this->forge->addForeignKey('CALIDADJURIDICAID', '', '');
        $this->forge->addForeignKey('ESTADOID', '', '');
        $this->forge->addForeignKey('MUNICIPIOID', '', '');
        $this->forge->addForeignKey('LOCALIDADID', '', '');
        $this->forge->addForeignKey('DELEGACIONID', '', '');
        $this->forge->addForeignKey('COLONIAID', '', '');
        $this->forge->createTable('EXPEDIENTEPERSONAMORAL');

         //TABLA EXPEDIENTE VEHICULO

         $this->forge->addField([
            'EXPEDIENTEVID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'VEHICULOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'SITUACION'       => [
                'type'           => 'INT',
                'constraint'     => '2',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TIPOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MARCAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MARCADESCR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MODELOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MODELODESCR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ANO'          => [
                'type'           => 'INT',
                'constraint'     => '4',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PLACAS'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'NUMEROSERIE'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'NUMEROMOTOR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'NUMEROCHASIS'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
          
            'TRANSMISION'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TRACCION'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PRIMERCOLORID'       => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'SEGUNDOCOLORID'       => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'SENASPARTICULARES'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '500',
                'null'=>TRUE,
            ],
            'PERSONAFISICAIDPROPIETARIO'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PERSONAMORALIDPROPIETARIO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'FOTO'       => [
                'type'           => 'BLOB',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTICIPAESTADO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'TIPOPLACA'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'ESTADOIDPLACA'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ESTADOEXTRANJEROIDPLACA'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'VEHICULODISTRIBUIDORID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'VEHICULOVERSIONID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'VEHICULOSERVICIOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'VEHICULOSTATUSID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHAREGISTRO'       => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PROVIENEPADRON'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'SEGUROVIGENTE'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'constraint'     => '1',
                'null'=>TRUE,
            ],
          
        ]);
        $this->forge->addKey('EXPEDIENTEVID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', '', '');
        $this->forge->addForeignKey('VEHICULOID', '', '');
        $this->forge->addForeignKey('TIPOID', '', '');
        $this->forge->addForeignKey('MARCAID', '', '');
        $this->forge->addForeignKey('MODELOID', '', '');
        $this->forge->addForeignKey('PRIMERCOLORID', '', '');
        $this->forge->addForeignKey('SEGUNDOCOLORID', '', '');
        $this->forge->addForeignKey('PERSONAFISICAIDPROPIETARIO', '', '');
        $this->forge->addForeignKey('PERSONAMORALIDPROPIETARIO', '', '');
        $this->forge->addForeignKey('ESTADOIDPLACA', '', '');
        $this->forge->addForeignKey('ESTADOEXTRANJEROIDPLACA', '', '');
        $this->forge->addForeignKey('VEHICULOVERSIONID', '', '');
        $this->forge->addForeignKey('VEHICULOSERVICIOID', '', '');
        $this->forge->addForeignKey('VEHICULOSTATUSID', '', '');
        $this->forge->createTable('EXPEDIENTEVEHICULO');
        
         //TABLA EXPEDIENTE DOCUMENTO

         $this->forge->addField([
            'EXPEDIENTEDID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'EXPEDIENTEDOCTOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'DOCTODESCR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'DOCUMENTO'          => [
                'type'           => 'BLOB',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHAACTUALIZACION'          => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHACREACION'          => [
                'type'           => 'DATE',
                'default' =>'CURRENT_TIMESTAMP',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHAIMPRESODEFINITIVA'          => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CLASIFICACIONDOCTOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'AUTOR'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'OFICINAIDAUTOR'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'STATUSDOCUMENTOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PLANTILLAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CALIFICACION'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ESTADOACCESO'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'M',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EMPLEADORESPONSABLE'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXPAREAIDRESPONSABLE'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXPEMPIDRESPONSABLE'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PUBLICADO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'RUTAALMACENAMIENTOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'STATUSALMACENID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXPORTAR'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '10',
                'null'=>TRUE,
            ],
         
        ]);
        $this->forge->addKey('EXPEDIENTEDID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', '', '');
        $this->forge->addForeignKey('EXPEDIENTEDOCTOID', '', '');
        $this->forge->addForeignKey('CLASIFICACIONDOCTOID', '', '');
        $this->forge->addForeignKey('OFICINAIDAUTOR', '', '');
        $this->forge->addForeignKey('STATUSDOCUMENTOID', '', '');
        $this->forge->addForeignKey('PLANTILLAID', '', '');
        $this->forge->addForeignKey('EXPAREAIDRESPONSABLE', '', '');
        $this->forge->addForeignKey('EXPEMPIDRESPONSABLE', '', '');
        $this->forge->addForeignKey('RUTAALMACENAMIENTOID', '', '');
        $this->forge->addForeignKey('STATUSALMACENID', '', '');
        $this->forge->createTable('EXPEDIENTEDOCUMENTO');
        
         //TABLA EXPEDIENTE OBJETO

         $this->forge->addField([
            'EXPEDIENTEOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'OBJETOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'SITUACION'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CLASIFICACIONID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'SUBCLASIFICACIONID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MARCA'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'NUMEROSERIE'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CANTIDAD'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'VALOR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TIPOMONEDAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'DESCRIPCION'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'DESCRIPCIONDETALLADA'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '500',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PERSONAFISICAIDPROPIETARIO'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PERSONAMORALIDPROPIETARIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FOTO'          => [
                'type'           => 'BLOB',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTICIPAESTADO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHAREGISTRO'       => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
        ]);
        $this->forge->addKey('EXPEDIENTEOID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', '', '');
        $this->forge->addForeignKey('OBJETOID', '', '');
        $this->forge->addForeignKey('CLASIFICACIONID', '', '');
        $this->forge->addForeignKey('SUBCLASIFICACIONID', '', '');
        $this->forge->addForeignKey('TIPOMONEDAID', '', '');
        $this->forge->addForeignKey('PERSONAFISICAIDPROPIETARIO', '', '');
        $this->forge->addForeignKey('PERSONAMORALIDPROPIETARIO', '', '');
        $this->forge->createTable('EXPEDIENTEOBJETO');
        
         //TABLA EXPEDIENTE ARCHIVO EXTERNO

         $this->forge->addField([
            'EXPEDIENTEAEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'EXPEDIENTEARCHIVOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'ARCHIVODESCR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CLASIFICACIONID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ARCHIVO'          => [
                'type'           => 'BLOB',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXTENSION'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHAACTUALIZACION'          => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'AUTOR'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'OFICINAIDAUTOR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CLASIFICACIONDOCTOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ESTADOACCESO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'M',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PUBLICADO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'RUTAALMACENAMIENTOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'STATUSALMACENID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXPORTAR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
        ]);
        $this->forge->addKey('EXPEDIENTEAEID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', '', '');
        $this->forge->addForeignKey('EXPEDIENTEARCHIVOID', '', '');
        $this->forge->addForeignKey('OFICINAIDAUTOR', '', '');
        $this->forge->addForeignKey('CLASIFICACIONDOCTOID', '', '');
        $this->forge->addForeignKey('RUTAALMACENAMIENTOID', '', '');
        $this->forge->addForeignKey('STATUSALMACENID', '', '');
        $this->forge->createTable('EXPARCHIVOEXTERNO');
        
         //TABLA EXPEDIENTE PERSONA FISICA IMPUTADO DELITO

         $this->forge->addField([
            'EXPEDIENTEPFIMID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'PERSONAFISICAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'DELITOMODALIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'DELITOCARACTERISTICAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TENTATIVA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'M',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
        ]);
        $this->forge->addKey('EXPEDIENTEPFIMID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', '', '');
        $this->forge->addForeignKey('PERSONAFISICAID', '', '');
        $this->forge->addForeignKey('DELITOMODALIDADID', '', '');
        $this->forge->addForeignKey('DELITOCARACTERISTICAID', '', '');
        $this->forge->createTable('EXPPERSONAFISIMPDELITO');
        
        //TABLA ATENCION AL CLIENTE

        $this->forge->addField([
            'IDATENCION'          => [
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
            ],
            'IDMUNICIPIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDCIUDADANO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDEXPEDIENTE'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDDERIVACION'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDAGENTE'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'ID_MODULO_SEJAP'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'NOTAS'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
            ],

        ]);
        $this->forge->addKey('IDATENCION', TRUE);
        $this->forge->addForeignKey('IDMUNICIPIO', 'CATEGORIA_MUNICIPIO', 'IDMUNICIPIO');
        $this->forge->addForeignKey('IDCIUDADANO', 'DENUNCIANTE', 'IDDENUNCIANTE');
        $this->forge->addForeignKey('IDEXPEDIENTE', '', '');
        $this->forge->addForeignKey('IDDERIVACION', 'DERIVACION', 'IDDERIVACION');
        $this->forge->addForeignKey('IDAGENTE', 'USUARIOS', 'IDUSUARIO');
        $this->forge->addForeignKey('ID_MODULO_SEJAP', '', '');
        $this->forge->createTable('ATENCION_CLIENTE');
    }

    public function down()
    {
        $this->forge->dropTable('proyecto_baja');
    }
}
