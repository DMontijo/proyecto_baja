<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FileOriginalesSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array(
				'ID' => '1', 'DESCRIPCION' => 'CERTIFICADO MEDICO', 'TITULO' => 'CERTIFICADO MEDICO',
				'PLACEHOLDER' => '<p class="p1" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">SOLICITUD DE PERITAJE</p><br>

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
				'TEXTO' => 'SOLICITUD DE PERITAJE


            No. de Caso: [EXPEDIENTE_NUMERO]
            
            
            DIRECTOR DE SERVICIOS PERICIALES
            Presente.-
            
            
            Por este conducto, solicito se sirva designar a los peritos médicos que se requieran, a fin de que dictamine(n) respecto de la(s) siguiente(s) solicitud(es) pericial(es):
            [DETALLE_INTERVENCIONES]
            
            
            A(los) de nombre(s):
            [VICTIMAS_NOMBRE]
            
            
            Lo anterior con el objeto de esclarecer los hechos correspondientes a la Carpeta de Investigación numero [EXPEDIENTE_NUMERO].
            
            
            Lo anterior con fundamento en el artículo 256 del Código de Procedimientos Penales vigente en el Estado y demás relativos a la Ley Orgánica de la Procuraduría General de Justicia del Estado de Baja California y su Reglamento.
            
            
            [DOCUMENTO_MUNICIPIO], BAJA CALIFORNIA
            [DOCUMENTO_FECHA]
            EL AGENTE DEL MINISTERIO PÚBLICO:
            
            
            
            ________________________________________
            
            LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]
            AGENTE DEL MINISTERIO PUBLICO TITULAR DE LA
            [DOCUMENTO_OFICINA]'
			),


			array(
				'ID' => '2', 'DESCRIPCION' => 'CONSTANCIA DE RECEPCIÓN DE VIDEO DENUNCIA', 'TITULO' => 'CONSTANCIA DE RECEPCIÓN DE VIDEO DENUNCIA',
				'PLACEHOLDER' => '<br><p class="p1" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">CONSTANCIA DE RECEPCIÓN DE VIDEO DENUNCIA</p><br><p class="p2" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
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
				'TEXTO' => '
            CONSTANCIA DE RECEPCIÓN DE VIDEO DENUNCIA
            
            
            En [ESTADO], Baja California, a los [DIA] días del mes de [MES] del año [ANO], siendo las [HORA] horas con [MINUTOS] minutos, la/el suscrita (o) Licenciada(o) [NOMBRE_LICENCIADO], Agente del Ministerio Público adscrita(o) al Centro de Denuncia Tecnológica, hace constar que se inicia video denuncia interpuesta por la/el ciudadana (o) [VICTIMA], quien manifesta en su entrevista que [HECHO], motivo por el que refiere es su deseo presentar denuncia/querella por el delito de [DELITO], previsto en el artículo [NUMERO_DELITO] del Código Penal [ORDENAMIENTO_LEGAL] en contra de [PERSONA], por tanto se genera [TIPO_EXPEDIENTE] 020[VARIABLE_PENDIENTE]-20[VARIABLE_PENDIENTE]-[VARIABLE_PENDIENTE], misma que será remitida a la Dirección de Zona [ZONA_SEJAP] para su debida remisión. Lo anterior de conformidad con el artículo 131 fracción II del Código Nacional de Procedimientos Penales, Artículo 20 inciso C de la Constitución Política de los Estados Unidos Mexicanos, así como el Artículo 22, fracción II y demás aplicables de la Ley Orgánica de la Fiscalía General del Estado de Baja California. CONSTE.
            
            
            
            EXPEDIENTE: [EXPEDIENTE_NUMERO]
            
            
            DIRECCIÓN DE SEGURIDAD PÚBLICA MUNICIPAL
            DOCUMENTO_MUNICIPIO,BAJA CALIFORNIA
            PRESENTE.-
            Presente.-
            
            
                            Por medio del presente, con fundamento en los artículos 21, 22, 23, 24, 25, 26 de la Ley de Acceso a las Mujeres a una Vida Libre de Violencia para el Estado de Baja California, art. 8 Fracc. VII de la Ley de Atención y protección a la Victimas u Ofendido del Delito para el estado de Baja California, articulo 109 fracciones XVI, XVIII y XIX y artículo 137 en sus Fracc. IV, V, VI, VII, VIII, IX y X del Código Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la victima de nombre [VICTIMA_NOMBRE] de [VICTIMA_EDAD], con telefono de contacto [VICTIMA_TELEFONO], para ser trasladada a las instalaciones del albergue temporal de CAVIM de esta ciudad, lo anterior con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE] de [IMPUTADO_EDAD]. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto.
            
            
            [DOCUMENTO_MUNICIPIO], BAJA CALIFORNIA, [DOCUMENTO_FECHA]
            
            
            
            EL AGENTE DEL MINISTERIO PÚBLICO
            
            
            ________________________________________
            
            EXPEDIENTE_NOMBRE_DEL_RESPONSABLE
            AGENTE DEL MINISTERIO PÚBLICO ADSCRITO A LA UNIDAD DE ATENCIÓN Y
            ORIENTACIÓN TEMPRANA (ORIENTACIÓN)
            
            '
			),

			array(
				'ID' => '3', 'DESCRIPCION' => 'ORDEN DE PROTECCION ALBERGUE', 'TITULO' => 'ORDEN DE PROTECCION ALBERGUE',
				'PLACEHOLDER' => '<br><p class="p1" style="margin: 0px; text-align: right; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">EXPEDIENTE: [EXPEDIENTE_NUMERO]</p><br>

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
				'TEXTO' => 'EXPEDIENTE: [EXPEDIENTE_NUMERO]


            DIRECCIÓN DE SEGURIDAD PÚBLICA MUNICIPAL
            DOCUMENTO_MUNICIPIO,BAJA CALIFORNIA
            PRESENTE.-
            Presente.-
            
            
                            Por medio del presente, con fundamento en los artículos 21, 22, 23, 24, 25, 26 de la Ley de Acceso a las Mujeres a una Vida Libre de Violencia para el Estado de Baja California, art. 8 Fracc. VII de la Ley de Atención y protección a la Victimas u Ofendido del Delito para el estado de Baja California, articulo 109 fracciones XVI, XVIII y XIX y artículo 137 en sus Fracc. IV, V, VI, VII, VIII, IX y X del Código Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la victima de nombre [VICTIMA_NOMBRE] de [VICTIMA_EDAD], con telefono de contacto [VICTIMA_TELEFONO], para ser trasladada a las instalaciones del albergue temporal de CAVIM de esta ciudad, lo anterior con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE] de [IMPUTADO_EDAD]. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto.
            
            
            [DOCUMENTO_MUNICIPIO], BAJA CALIFORNIA, [DOCUMENTO_FECHA]
            
            
            
            EL AGENTE DEL MINISTERIO PÚBLICO
            
            
            ________________________________________
            
            [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]
            AGENTE DEL MINISTERIO PÚBLICO ADSCRITO A LA UNIDAD DE ATENCIÓN Y
            ORIENTACIÓN TEMPRANA (ORIENTACIÓN)
            
            '
			),


			array(
				'ID' => '4', 'DESCRIPCION' => 'ORDEN DE PROTECCION RECOGER PERTENENCIAS', 'TITULO' => 'ORDEN DE PROTECCION RECOGER PERTENENCIAS',
				'PLACEHOLDER' => '<br><p class="p1" style="margin: 0px; text-align: right; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">EXPEDIENTE: [EXPEDIENTE_NUMERO]</p><br><p class="p2" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            DIRECCIÓN DE SEGURIDAD PÚBLICA MUNICIPAL <br>
            [DOCUMENTO_MUNICIPIO],BAJA CALIFORNIA <br>
            PRESENTE.- <br></p><br><p class="p3" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Por medio del presente, con fundamento en el artículo 8 Fracc. VII de la Ley de Atención y protección a la Victimas u Ofendido del Delito para el estado de Baja California, articulo 109 fracciones XVI, XVIII y XIX y artículo 137 en sus Fracc. IV, V, VI, VII, VIII, IX y X del Código Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la victima de nombre [VICTIMA_NOMBRE] de [VICTIMA_EDAD] AÑOS, con teléfono de contacto [VICTIMA_TELEFONO], para ser trasladado al domicilio ubicado [VICTIMA_DOMICILIO], tijuana, BAJA CALIFORNIA y se encuentre en la posibilidad de recoger pertenencias, lo anterior con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE] de [IMPUTADO_EDAD] AÑOS. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto.
            </p><br><p class="p4" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">[DOCUMENTO_CIUDAD], BAJA CALIFORNIA, [DOCUMENTO_FECHA] <br></p><br><br><p class="p5" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            EL AGENTE DEL MINISTERIO PÚBLICO<br></p><br><p class="p6" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            ________________________________________<br></p> <p class="p7" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE] <br>
            AGENTE DEL MINISTERIO PÚBLICO ADSCRITO A LA UNIDAD DE ATENCIÓN Y <br>
            ORIENTACIÓN TEMPRANA (ORIENTACIÓN) <br></p><br>',
				'TEXTO' => 'EXPEDIENTE: [EXPEDIENTE_NUMERO]


            DIRECCIÓN DE SEGURIDAD PÚBLICA MUNICIPAL
            [DOCUMENTO_MUNICIPIO],BAJA CALIFORNIA
            PRESENTE.-
            
            
                            Por medio del presente, con fundamento en el artículo 8 Fracc. VII de la Ley de Atención y protección a la Victimas u Ofendido del Delito para el estado de Baja California, articulo 109 fracciones XVI, XVIII y XIX y artículo 137 en sus Fracc. IV, V, VI, VII, VIII, IX y X del Código Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la victima de nombre [VICTIMA_NOMBRE] de [VICTIMA_EDAD] AÑOS, con teléfono de contacto [VICTIMA_TELEFONO], para ser trasladado al domicilio ubicado [VICTIMA_DOMICILIO], tijuana, BAJA CALIFORNIA y se encuentre en la posibilidad de recoger pertenencias, lo anterior con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE] de [IMPUTADO_EDAD] AÑOS. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto.
            
            
            [DOCUMENTO_CIUDAD], BAJA CALIFORNIA, [DOCUMENTO_FECHA]
            
            
            
            EL AGENTE DEL MINISTERIO PÚBLICO
            
            
            ________________________________________
            
            LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]
            AGENTE DEL MINISTERIO PÚBLICO ADSCRITO A LA UNIDAD DE ATENCIÓN Y
            ORIENTACIÓN TEMPRANA (ORIENTACIÓN)
            
            '
			),


			array(
				'ID' => '5', 'DESCRIPCION' => 'ORDEN DE PROTECCION RONDINES', 'TITULO' => 'ORDEN DE PROTECCION RONDINES',
				'PLACEHOLDER' => '<br><p class="p1" style="margin: 0px; text-align: right; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">EXPEDIENTE: [EXPEDIENTE_NUMERO]
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
				'TEXTO' => '
            EXPEDIENTE: [EXPEDIENTE_NUMERO]
            
            
            C. DIRECCIÓN DE SEGURIDAD PÚBLICA MUNICIPAL
            MEXICALI, BAJA CALIFORNIA
            PRESENTE.-
            
            
                          Por medio del presente, con fundamento en el artículo 8 Fracc. VII de la Ley de Atención y protección a la Victimas u Ofendido del Delito para el Estado de Baja California, articulo 109 fracciones XVI, XVIII y XIX y artículo 137 en sus Fracc. IV, V, VI, VII, VIII, IX y X del Código Nacional de Procedimientos Penales vigente en el Estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la victima de nombre [VICTIMA_NOMBRE] de [VICTIMA_EDAD] AÑOS , a efectos de que realicen rondines de vigilancia por 72 horas en el domicilio ubicado en [VICTIMA_DOMICILIO], tijuana, BAJA CALIFORNIA de esta ciudad, con teléfono de contacto el [VICTIMA_TELEFONO], con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE] de [IMPUTADO_EDAD] EDAD. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto.
            
            
            [DOCUMENTO_CIUDAD], BAJA CALIFORNIA, [DOCUMENTO_FECHA]
            
            
            EL AGENTE DEL MINISTERIO PÚBLICO
            
            
            
            ________________________________________
            
            LIC. [EXPEDIENTE_NOMBRE_MP_RESPONSABLE]
            AGENTE DEL MINISTERIO PUBLICO ADSCRITO A LA UNIDAD DE ATENCIÓN Y
            ORIENTACIÓN TEMPRANA(ORIENTACIÓN)'
			),


			array(
				'ID' => "6", 'DESCRIPCION' => 'CONSTANCIA DE EXTRAVÍO', 'TITULO' => 'CONSTANCIA DE EXTRAVÍO', 'PLACEHOLDER' => '<br><p class="p1" style="margin: 0px; text-align: right; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;"><strong>FOLIO: [FOLIO_NUMERO]</strong></p><br>

            <p class="p2" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            El C.AGENTE DEL MINISTERIO PÚBLICO <br>
            <strong>[NOMBRE_AGENTE] </strong><br> </p><br>
                
            <p class="p3" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; HACE CONSTAR QUE EL CONTROL DE REPORTES QUE SE LLEVÓ A CABO EN ESTA OFICINA, HA QUEDADO REGISTRADO EL REPORTE DE PÉRDIDA DE: <strong>[NOMBRE_CERTIFICADO]</strong>
            <br>
            LA PÉRDIDA DE DICHO(A) <strong>[NOMBRE_CERTIFICADO]</strong> OCURRIÓ BAJO LAS SIGUIENTES CIRCUNSTANCIAS DE LUGAR.
            <br>
            MANIFIESTA EL COMPARECIENTE HABER EXTRAVIADO EL ORIGINAL DE <strong>[NOMBRE_CERTIFICADO]</strong>, NÚMERO:, A NOMBRE DE: <strong>[NOMBRE_PERSONA]</strong>
            <br>
            </p><br>
            <table class="t1" style="border:1px solid black;  margin-left: auto;margin-right: auto;">
                <tr style=" border:1px solid black;">
                    <th style=" border:1px solid black;">COMPARECIENTE</th>
                    <th style=" border:1px solid black;">[NOMBRE_PERSONA]</th>
                </tr>
                <tr style=" border:1px solid black;">
                    <th style=" border:1px solid black;">LUGAR DE EXTRAVÍO</th>
                    <th style=" border:1px solid black;">[LUGAR_EXTRAVIO]</th>
                </tr>
                <tr style=" border:1px solid black;">
                    <th style=" border:1px solid black;">FECHA DE EXTRAVÍO</th>
                    <th style=" border:1px solid black;">[FECHA_EXTRAVIO]</th>
                </tr>
                <tr style=" border:1px solid black;">
                    <th style=" border:1px solid black;">DESCRIPCIÓN</th>
                    <th style=" border:1px solid black;">[DESCRIPCION_EXTRAVIO]</th>
                </tr>
            </table>
            <br>
            <p class="p4" style="margin: 0px; text-align: justify; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); min-height: 14px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            SE EXPIDE LA PRESENTE CONSTANCIA EN LA CIUDAD DE: <strong>[NOMBRE_CIUDAD]</strong> A LOS <strong>[DIA]</strong> DÍAS DEL MES DE <strong>[MES]</strong> DEL AÑO <strong>[ANIO]</strong> A LAS <strong>[HORA]</strong>; LA CUAL NO SUSTITUYE EL DOCUMENTO ORIGINAL NI VALIDA LA PREEXISTENCIA DEL DOCUMENTO U OBJETO
            </p><br>
                
                <br>
                <br>
                <br>
            
                <br>
                <br>
                <br>
            
                <br>
                <br>
                <br>
            
            <p class="p6" style="margin: 0px; text-align: center; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 11px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0);">
            <strong>[NOMBRE_AGENTE]</strong> <br>
            AGENTE DEL MINISTERIO PÚBLICO ADSCRITO AL SISTEMA<br>
            ESTATAL DE JUSTICIA ALTERNATIVA PENAL<br></p><br>', 'TEXTO' => '
            FOLIO: [FOLIO_NUMERO]
            
            
            El C.AGENTE DEL MINISTERIO PÚBLICO
            [NOMBRE_AGENTE]
            
                            HACE CONSTAR QUE EL CONTROL DE REPORTES QUE SE LLEVÓ A CABO EN ESTA OFICINA, HA QUEDADO REGISTRADO EL REPORTE DE PÉRDIDA DE: [NOMBRE_CERTIFICADO]
            LA PÉRDIDA DE DICHO(A) [NOMBRE_CERTIFICADO] OCURRIÓ BAJO LAS SIGUIENTES CIRCUNSTANCIAS DE LUGAR.
            MANIFIESTA EL COMPARECIENTE HABER EXTRAVIADO EL ORIGINAL DE [NOMBRE_CERTIFICADO], NÚMERO:, A NOMBRE DE: [NOMBRE_PERSONA]
            
            COMPARECIENTE	[NOMBRE_PERSONA]
            LUGAR DE EXTRAVÍO	[LUGAR_EXTRAVIO]
            FECHA DE EXTRAVÍO	[FECHA_EXTRAVIO]
            DESCRIPCIÓN	[DESCRIPCION_EXTRAVIO]
            
                            SE EXPIDE LA PRESENTE CONSTANCIA EN LA CIUDAD DE: [NOMBRE_CIUDAD] A LOS [DIA] DÍAS DEL MES DE [MES] DEL AÑO [ANIO] A LAS [HORA]; LA CUAL NO SUSTITUYE EL DOCUMENTO ORIGINAL NI VALIDA LA PREEXISTENCIA DEL DOCUMENTO U OBJETO
            
            
            
            
            
            
            
            
            
            
            
            [NOMBRE_AGENTE]
            AGENTE DEL MINISTERIO PÚBLICO ADSCRITO AL SISTEMA
            ESTATAL DE JUSTICIA ALTERNATIVA PENA'
			),




		];

		$this->db->table('PLANTILLAS')->insertBatch($data);
	}
}
