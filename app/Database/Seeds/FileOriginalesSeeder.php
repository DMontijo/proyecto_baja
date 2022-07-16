<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FileOriginalesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('ID' => '1', 'DESCRIPCION' => 'CERTIFICADO MEDICO', 'TITULO'=>'CERTIFICADO MEDICO',
            'PLACEHOLDER'=>'<p class="p1" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">SOLICITUD DE PERITAJE</p><br>

            <p class="p2" style="margin: 0px; text-align: right; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">No. de Caso: [EXPEDIENTE_NUMERO]</p><br>
            
            <p class="p3" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">DIRECTOR DE SERVICIOS PERICIALES <br> Presente.-</p><br>
                
            <p class="p4" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">Por este conducto, solicito se sirva designar a los peritos médicos que se requieran, a fin de que dictamine(n) respecto de la(s) siguiente(s) solicitud(es) pericial(es):<br>
            [DETALLE_INTERVENCIONES]</p><br>
                
            <p class="p5" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">A(los) de nombre(s): <br>
            [VICTIMAS_NOMBRE]<br></p><br>
                
            <p class="p6" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            Lo anterior con el objeto de esclarecer los hechos correspondientes a la Carpeta de Investigación numero [EXPEDIENTE_NUMERO].
            <br></p><br>
            
            <p class="p7" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            Lo anterior con fundamento en el artículo 256 del Código de Procedimientos Penales vigente en el Estado y demás relativos a la Ley Orgánica de la Procuraduría General de Justicia del Estado de Baja California y su Reglamento.
            <br></p><br>
            
            <p class="p8" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            [DOCUMENTO_MUNICIPIO], BAJA CALIFORNIA <br>
            [DOCUMENTO_FECHA] <br>
            EL AGENTE DEL MINISTERIO PÚBLICO: <br>
            <br></p><br>
            
            <p class="p9" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            ________________________________________<br></p>
            
            <p class="p10" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE] <br>
            AGENTE DEL MINISTERIO PUBLICO TITULAR DE LA <br>
            [DOCUMENTO_OFICINA] <br></p><br>',
            'OPCIONES'=>'NULL','TIPO_ARCHIVO'=>'CERTIFICADO MEDICO','RELACIONADO_CON'=>'0','MODIFICADO'=>'0','ELIMINADO'=>'0','DENUNCIANTEID'=>'NULL'),
            
         
            array('ID' => '2', 'DESCRIPCION' => 'CONSTANCIA DE RECEPCIÓN DE VIDEO DENUNCIA', 'TITULO'=>'CONSTANCIA DE RECEPCIÓN DE VIDEO DENUNCIA',
            'PLACEHOLDER'=>'<br><p class="p1" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">CONSTANCIA DE RECEPCIÓN DE VIDEO DENUNCIA</p><br><p class="p2" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            En [ESTADO], Baja California, a los [DIA] días del mes de [MES] del año [ANO], siendo las [HORA] horas con [MINUTOS] minutos, la/el suscrita (o) Licenciada(o) [NOMBRE_LICENCIADO], Agente del Ministerio Público adscrita(o) al Centro de Denuncia Tecnológica, hace constar que se inicia video denuncia interpuesta por la/el ciudadana (o) [VICTIMA], quien manifesta en su entrevista que [HECHO], motivo por el que refiere es su deseo presentar denuncia/querella por el delito de [DELITO], previsto en el artículo [NUMERO_DELITO] del Código Penal [ORDENAMIENTO_LEGAL] en contra de [PERSONA],  por tanto se genera [TIPO_EXPEDIENTE] 020[VARIABLE_PENDIENTE]-20[VARIABLE_PENDIENTE]-[VARIABLE_PENDIENTE], misma que será remitida a la Dirección de Zona [ZONA_SEJAP] para su debida remisión. Lo anterior de conformidad con el artículo 131 fracción II del Código Nacional de Procedimientos Penales, Artículo 20 inciso C de la Constitución Política de los Estados Unidos Mexicanos, así como el Artículo 22, fracción II y demás aplicables de la Ley Orgánica de la Fiscalía General del Estado de Baja California. CONSTE.
            <br></p><br><br><p class="p1" style="margin: 0px; text-align: right; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">EXPEDIENTE: [EXPEDIENTE_NUMERO]</p><br><p class="p2" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            DIRECCIÓN DE SEGURIDAD PÚBLICA MUNICIPAL <br>
            DOCUMENTO_MUNICIPIO,BAJA CALIFORNIA <br>
            PRESENTE.- <br> Presente.- </p><br><p class="p3" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Por medio del presente, con fundamento en los artículos 21, 22, 23, 24, 25, 26 de la Ley de Acceso a las Mujeres a una Vida Libre de Violencia para el Estado de Baja California, art. 8 Fracc. VII  de la Ley de Atención y protección a la Victimas u Ofendido  del Delito para el estado de Baja California,  articulo 109 fracciones XVI, XVIII y XIX y artículo 137  en sus Fracc. IV, V, VI, VII, VIII, IX y X  del Código Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la victima de nombre [VICTIMA_NOMBRE] de [VICTIMA_EDAD], con telefono de contacto [VICTIMA_TELEFONO], para ser trasladada a las instalaciones del albergue temporal de CAVIM de esta ciudad, lo anterior con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE] de [IMPUTADO_EDAD]. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto.
            </p><br><p class="p4" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">[DOCUMENTO_MUNICIPIO], BAJA CALIFORNIA, [DOCUMENTO_FECHA]<br></p><br><br>

            <p class="p5" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            EL AGENTE DEL MINISTERIO PÚBLICO<br></p><br>
            
            <p class="p6" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            ________________________________________<br></p>
            
            <p class="p7" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            EXPEDIENTE_NOMBRE_DEL_RESPONSABLE <br>
            AGENTE DEL MINISTERIO PÚBLICO ADSCRITO A LA UNIDAD DE ATENCIÓN Y <br>
            ORIENTACIÓN TEMPRANA (ORIENTACIÓN) <br></p><br>',
            'OPCIONES'=>'NULL','TIPO_ARCHIVO'=>'CONSTANCIA DE RECEPCIÓN DE VIDEO DENUNCIA','RELACIONADO_CON'=>'0','MODIFICADO'=>'0','ELIMINADO'=>'0','DENUNCIANTEID'=>'NULL'),
            
            array('ID' => '3', 'DESCRIPCION' => 'ORDEN DE PROTECCION ALBERGUE', 'TITULO'=>'ORDEN DE PROTECCION ALBERGUE',
            'PLACEHOLDER'=>'<br><p class="p1" style="margin: 0px; text-align: right; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">EXPEDIENTE: [EXPEDIENTE_NUMERO]</p><br>

            <p class="p2" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            DIRECCIÓN DE SEGURIDAD PÚBLICA MUNICIPAL <br>
            DOCUMENTO_MUNICIPIO,BAJA CALIFORNIA <br>
            PRESENTE.- <br> Presente.- </p><br>
                
            <p class="p3" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Por medio del presente, con fundamento en los artículos 21, 22, 23, 24, 25, 26 de la Ley de Acceso a las Mujeres a una Vida Libre de Violencia para el Estado de Baja California, art. 8 Fracc. VII  de la Ley de Atención y protección a la Victimas u Ofendido  del Delito para el estado de Baja California,  articulo 109 fracciones XVI, XVIII y XIX y artículo 137  en sus Fracc. IV, V, VI, VII, VIII, IX y X  del Código Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la victima de nombre [VICTIMA_NOMBRE] de [VICTIMA_EDAD], con telefono de contacto [VICTIMA_TELEFONO], para ser trasladada a las instalaciones del albergue temporal de CAVIM de esta ciudad, lo anterior con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE] de [IMPUTADO_EDAD]. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto.
            </p><br>
                
            <p class="p4" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">[DOCUMENTO_MUNICIPIO], BAJA CALIFORNIA, [DOCUMENTO_FECHA]<br></p><br><br>
            
            <p class="p5" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            EL AGENTE DEL MINISTERIO PÚBLICO<br></p><br>
            
            <p class="p6" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            ________________________________________<br></p>
            
            <p class="p7" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE] <br>
            AGENTE DEL MINISTERIO PÚBLICO ADSCRITO A LA UNIDAD DE ATENCIÓN Y <br>
            ORIENTACIÓN TEMPRANA (ORIENTACIÓN) <br></p><br>',
            'OPCIONES'=>'NULL','TIPO_ARCHIVO'=>'ORDEN DE PROTECCION ALBERGUE','RELACIONADO_CON'=>'0','MODIFICADO'=>'0','ELIMINADO'=>'0','DENUNCIANTEID'=>'NULL'),
            

            array('ID' => '4', 'DESCRIPCION' => 'ORDEN DE PROTECCION RECOGER PERTENENCIAS', 'TITULO'=>'ORDEN DE PROTECCION RECOGER PERTENENCIAS',
            'PLACEHOLDER'=>'<br><p class="p1" style="margin: 0px; text-align: right; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">EXPEDIENTE: [EXPEDIENTE_NUMERO]</p><br><p class="p2" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            DIRECCIÓN DE SEGURIDAD PÚBLICA MUNICIPAL <br>
            [DOCUMENTO_MUNICIPIO],BAJA CALIFORNIA <br>
            PRESENTE.- <br></p><br><p class="p3" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Por medio del presente, con fundamento en el artículo 8 Fracc. VII de la Ley de Atención y protección a la Victimas u Ofendido del Delito para el estado de Baja California, articulo 109 fracciones XVI, XVIII y XIX y artículo 137 en sus Fracc. IV, V, VI, VII, VIII, IX y X del Código Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la victima de nombre [VICTIMA_NOMBRE] de [VICTIMA_EDAD] AÑOS, con teléfono de contacto [VICTIMA_TELEFONO], para ser trasladado al domicilio ubicado [VICTIMA_DOMICILIO], tijuana, BAJA CALIFORNIA y se encuentre en la posibilidad de recoger pertenencias, lo anterior con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE] de [IMPUTADO_EDAD] AÑOS. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto.
            </p><br><p class="p4" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">[DOCUMENTO_CIUDAD], BAJA CALIFORNIA, [DOCUMENTO_FECHA] <br></p><br><br><p class="p5" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            EL AGENTE DEL MINISTERIO PÚBLICO<br></p><br><p class="p6" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            ________________________________________<br></p> <p class="p7" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE] <br>
            AGENTE DEL MINISTERIO PÚBLICO ADSCRITO A LA UNIDAD DE ATENCIÓN Y <br>
            ORIENTACIÓN TEMPRANA (ORIENTACIÓN) <br></p><br>',
            'OPCIONES'=>'NULL','TIPO_ARCHIVO'=>'ORDEN DE PROTECCION RECOGER PERTENENCIAS','RELACIONADO_CON'=>'0','MODIFICADO'=>'0','ELIMINADO'=>'0','DENUNCIANTEID'=>'NULL'),
            
            
            array('ID' => '5', 'DESCRIPCION' => 'ORDEN DE PROTECCION RONDINES', 'TITULO'=>'ORDEN DE PROTECCION RONDINES',
            'PLACEHOLDER'=>'<br><p class="p1" style="margin: 0px; text-align: right; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">EXPEDIENTE: [EXPEDIENTE_NUMERO]
            </p><br>
            
            <p class="p2" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">
            C. DIRECCIÓN DE SEGURIDAD PÚBLICA MUNICIPAL <br>
            MEXICALI, BAJA CALIFORNIA <br>
            PRESENTE.- <br></p><br>
            
            <p class="p3" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Por medio del presente, con fundamento en el artículo 8 Fracc. VII de la Ley de Atención y protección a la Victimas u Ofendido del Delito para el Estado de Baja California, articulo 109 fracciones XVI, XVIII y XIX y artículo 137 en sus Fracc. IV, V, VI, VII, VIII, IX y X del Código Nacional de Procedimientos Penales vigente en el Estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la victima de nombre [VICTIMA_NOMBRE] de [VICTIMA_EDAD] AÑOS , a efectos de que realicen rondines de vigilancia por 72 horas en el domicilio ubicado en [VICTIMA_DOMICILIO], tijuana, BAJA CALIFORNIA de esta ciudad, con teléfono de contacto el [VICTIMA_TELEFONO], con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE] de [IMPUTADO_EDAD] EDAD. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto. <br></p><br>
                
            <p class="p4" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">[DOCUMENTO_CIUDAD], BAJA CALIFORNIA, [DOCUMENTO_FECHA]</p><br>
                
            <p class="p5" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">EL AGENTE DEL MINISTERIO PÚBLICO <br></p><br><br>
            
            <p class="p6" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            ________________________________________<br></p>
                
            <p class="p7" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            LIC. [EXPEDIENTE_NOMBRE_MP_RESPONSABLE] <br>
            AGENTE DEL MINISTERIO PUBLICO ADSCRITO A LA UNIDAD DE ATENCIÓN Y <br> 
            ORIENTACIÓN TEMPRANA(ORIENTACIÓN)<br></p><br>',
            'OPCIONES'=>'NULL','TIPO_ARCHIVO'=>'ORDEN DE PROTECCION RONDINES','RELACIONADO_CON'=>'0','MODIFICADO'=>'0','ELIMINADO'=>'0','DENUNCIANTEID'=>'NULL'),
            
         
        
        ];
        
        $this->db->table('FILES_ORIGINALES')->insertBatch($data);
    }
}
