<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PlantillasSeeder extends Seeder
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
				'ID' => "6", 'DESCRIPCION' => 'CONSTANCIA DE EXTRAVÍO', 'TITULO' => 'CONSTANCIA DE EXTRAVÍO', 'PLACEHOLDER' => '<br><p class="p1" style="margin: 0px; text-align: right; color: #000000;">
				<strong>FOLIO: [FOLIO_NUMERO]/[ANIO]</strong>
			</p>
			<br>
			<p class="p1" style="margin: 0px; text-align: right; color: #000000;">
				&nbsp;
			</p>
			<p class="p2" style="margin: 0px; text-align: justify; color: #000000;">
				El C.AGENTE DEL MINISTERIO P&Uacute;BLICO <br>
				<strong>[NOMBRE_AGENTE_FIRMA]</strong>
			</p>
			<p class="p2" style="margin: 0px; text-align: justify; color: #000000;">
				&nbsp;
			</p>
			<p class="p3" style="margin: 0px; text-align: justify; color: #000000;">
				HACE CONSTAR QUE EN EL CONTROL DE REPORTES QUE SE LLEV&Oacute; A CABO EN
				ESTA OFICINA, HA QUEDADO LA PERDIDA DE:
				<strong>[NOMBRE_CERTIFICADO]</strong>, OCURRIENDO BAJO LAS SIGUIENTES
				CIRCUNSTANCIAS.
			</p>
			<br>
			<p class="p3" style="margin: 0px; text-align: justify; color: #000000;">
				MANIFIESTA EL COMPARECIENTE HABER EXTRAVIADO EL ORIGINAL DE
				<strong>[NOMBRE_CERTIFICADO]</strong>, N&Uacute;MERO:
				<strong>[NO_DOCUMENTO]</strong>, A NOMBRE DE:
				<strong>[NOMBRE_DUENO]</strong>.
			</p>
			<br>
			<table
				class="t1"
				style="border-collapse: collapse; margin-left: auto; margin-right: auto; word-wrap: break-word; width: 100%;"
				bordercolor="#000000"
			>
				<tbody>
					<tr style="border: 2px solid black;margin:0;">
						<td
							style="border: 2px solid black;margin:0; padding: 5px; width: 25%;"
						>
							COMPARECIENTE
						</td>
						<td style="border: 2px solid black;margin:0; padding: 5px;">
							<strong>[NOMBRE_COMPARECIENTE]</strong>
						</td>
					</tr>
					<tr style="border: 2px solid black;margin:0;">
						<td
							style="border: 2px solid black;margin:0; padding: 5px; width: 25%;"
						>
							DOMICILIO
						</td>
						<td style="border: 2px solid black;margin:0; padding: 5px;">
							<strong>[DOMICILIO_COMPARECIENTE]</strong>
						</td>
					</tr>
					<tr style="border: 2px solid black;margin:0;">
						<td
							style="border: 2px solid black;margin:0; padding: 5px; width: 25%;"
						>
							LUGAR DE EXTRAV&Iacute;O
						</td>
						<td style="border: 2px solid black;margin:0; padding: 5px;">
							<strong>[LUGAR_EXTRAVIO]</strong>
						</td>
					</tr>
					<tr style="border: 2px solid black;margin:0;">
						<td
							style="border: 2px solid black;margin:0; padding: 5px; width: 25%;"
						>
							FECHA DE EXTRAV&Iacute;O
						</td>
						<td style="border: 2px solid black;margin:0; padding: 5px;">
							<strong>[FECHA_EXTRAVIO]</strong>
						</td>
					</tr>
					<tr style="border: 2px solid black;margin:0;">
						<td
							style="border: 2px solid black;margin:0; padding: 5px; width: 25%;"
						>
							DESCRIPCI&Oacute;N
						</td>
						<td style="border: 2px solid black;margin:0; padding: 5px;">
							<strong>[DESCRIPCION_EXTRAVIO]</strong>
						</td>
					</tr>
				</tbody>
			</table>
			<br>
			<p class="p4" style="margin: 0px; text-align: justify; color: #000000;">
				SE EXPIDE LA PRESENTE CONSTANCIA EN LA CIUDAD DE:
				<strong>[NOMBRE_CIUDAD]</strong> A LOS <strong>[DIA]</strong> D&Iacute;AS
				DEL MES DE <strong>[MES]</strong> DEL A&Ntilde;O
				<strong>[ANIO_FIRMA]</strong> A LAS <strong>[HORA]</strong>; LA CUAL NO
				SUSTITUYE EL DOCUMENTO ORIGINAL NI VALIDA LA PREEXISTENCIA DEL DOCUMENTO U
				OBJETO
			</p>
			<br>
			<p class="p6" style="margin: 0px; text-align: center; color: #000000;">
				<strong>[NOMBRE_AGENTE_FIRMA]</strong><br>
				AGENTE DEL MINISTERIO P&Uacute;BLICO ADSCRITO AL SISTEMA<br>
				ESTATAL DE JUSTICIA ALTERNATIVA PENAL
			</p>
			<br>
			<div>
				<p
					class="p7"
					style="margin: 0px; text-align: center; color: #000000; background-color: #959393; padding: 10px;"
				>
					<span style="color: #ffffff;"
						><strong>DATOS FIRMA ELECTR&Oacute;NICA</strong></span
					>
				</p>
			</div>
			<div style="display: flex; flex-direction: row; flex-wrap: wrap;">
				<div style="width: 75%; float: left;">
					<br>
					<p style="margin: 0px; text-align: left;">
						<strong>IDENTIFICADOR ELECTR&Oacute;NICO:</strong>
						[NUMEROIDENTIFICADOR]
					</p>
					<p style="margin: 0px; text-align: left;">
						<strong>AGENTE DEL MINISTERIO P&Uacute;BLICO:</strong>
						[NOMBRE_AGENTE_FIRMA]
					</p>
					<p style="margin: 0px; text-align: left;">
						<strong>RFC AGENTE DEL MINISTERIO P&Uacute;BLICO:</strong>
						[RFCFIRMA_FIRMA]
					</p>
					<p style="margin: 0px; text-align: left;">
						<strong
							>NO. DE CERTIFICACI&Oacute;N DE FIRMA
							ELECTR&Oacute;NICA:</strong
						>
						[NCERTIFICADOFIRMA]
					</p>
					<p style="margin: 0px; text-align: left;">
						<strong>FECHA DE FIRMA:</strong> [FECHAFIRMA]
					</p>
					<p style="margin: 0px; text-align: left;">
						<strong>HORA DE FIRMA:</strong> [HORAFIRMA]
					</p>
					<p style="margin: 0px; text-align: left;">
						<strong>LUGAR DE FIRMA:</strong> [LUGARFIRMA]
					</p>
					<p style="margin: 0px; text-align: left;">
						&nbsp;
					</p>
				</div>
				<div style="width: 25%; float: right; word-wrap: break-word;">
					<br>
					<p style="margin: 0px; text-align: center;">
						[CODIGO_QR_1]
					</p>
					<p style="margin: 0px; text-align: center;">
						[URL]
					</p>
				</div>
			</div>
			<div style="display: flex; flex-direction: row; flex-wrap: wrap; word-wrap: break-word;">
				<div style="width: 30%;">
					<p style="margin: 0px; text-align: justify;">
						<strong>FIRMA ELECTR&Oacute;NICA</strong>
					</p>
				</div>
				<div style="width: 100%;">
					<p style="margin: 0px; text-align: justify;">
						[FIRMAELECTRONICA]
					</p>
				</div>
			</div>
			<div style="float: left;">
				<p style="margin: 0px; text-align: left;">
					[CODIGO_QR_2]
				</p>
			</div>
			', 'TEXTO' => 'El C.AGENTE DEL MINISTERIO PÚBLICO [NOMBRE_AGENTE_FIRMA]|HACE CONSTAR QUE EN EL CONTROL DE REPORTES QUE SE LLEVÓ A CABO EN ESTA OFICINA, HA QUEDADO LA PERDIDA DE: [NOMBRE_CERTIFICADO], OCURRIENDO BAJO LAS SIGUIENTES CIRCUNSTANCIAS|MANIFIESTA EL COMPARECIENTE HABER EXTRAVIADO EL ORIGINAL DE [NOMBRE_CERTIFICADO], NÚMERO: [NO_DOCUMENTO], A NOMBRE DE: [NOMBRE_DUENO]|COMPARECIENTE [NOMBRE_COMPARECIENTE]|DOMICILIO [DOMICILIO_COMPARECIENTE]|LUGAR DE EXTRAVÍO [LUGAR_EXTRAVIO]|FECHA DE EXTRAVÍO [FECHA_EXTRAVIO]|DESCRIPCION [DESCRIPCION_EXTRAVIO]|SE EXPIDE LA PRESENTE CONSTANCIA EN LA CIUDAD DE: [NOMBRE_CIUDAD] A LOS [DIA] DÍAS DEL MES DE [MES] DEL AÑO [ANIO_FIRMA] A LAS [HORA]; LA CUAL NO SUSTITUYE EL DOCUMENTO ORIGINAL NI VALIDA LA PREEXISTENCIA DEL DOCUMENTO U OBJETO'
			),
		];

		$this->db->table('PLANTILLAS')->insertBatch($data);
	}
}
