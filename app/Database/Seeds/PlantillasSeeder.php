<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PlantillasSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array(
				'DESCRIPCION' => '', 'TITULO' => 'ACEPTACION DE PROCESO EN JUSTICIA ALTERNATIVA CNPP',
				'PLACEHOLDER' => '<p style="text-align: center;"><strong>ACEPTACI&Oacute;N DE SERVICIO (SOLICITANTE)</strong></p><p>&nbsp;</p><p style="text-align: right;"><strong>EXPEDIENTE: [EXPEDIENTE_NUMERO]/RAC/SEJAP</strong></p><p>&nbsp;</p><p style="text-align: justify;">&nbsp; &nbsp; &nbsp;En [DOCUMENTO_CIUDAD], Baja California, a [DOCUMENTO_FECHA], (&eacute;l) (la) C. [VICTIMA_NOMBRE] quien se identifica con: [VICTIMA_TIPO_IDENTIFICACION], con n&uacute;mero [VICTIMA_NUMERO_IDENTIFICACION], con domicilio en [VICTIMA_DOMICILIO], Tel&eacute;fono casa: [VICTIMA_TELEFONO], Cel. [VICTIMA_TELEFONO_CELULAR], Trabajo [VICTIMA_TELEFONO_CELULAR], edad [VICTIMA_EDAD], Oficio [VICTIMA_OCUPACION], Nacionalidad [VICTIMA_NACIONALIDAD], Estado Civil [VICTIMA_ESTADO_CIVIL], manifiesto: Que entiendo y acepto los servicios que me ofrece el CENTRO DE DENUNCIA TECNOL&Oacute;GICA; con la finalidad de llevar a cabo el procedimiento de mediaci&oacute;n, ACEPTO participar voluntariamente al mismo, para abordar un conflicto con: [IMPUTADO_NOMBRE]. Asimismo, manifiesto que se me ha informado acerca de los derechos, obligaciones, caracter&iacute;sticas y reglas del procedimiento, mismos que se encuentran establecidos en la Ley Nacional de Mecanismos Alternativos de Soluci&oacute;n de Controversias en Materia Penal y C&oacute;digo Nacional de Procedimientos Penales, habiendo recibido a dem&aacute;s copia simple del presente documento; De igual forma manifiesto mi obligaci&oacute;n de INFORMAR INMEDIATAMENTE CUANDO DESEE dar por concluido el Procedimiento Alterno, seg&uacute;n el art&iacute;culo 32 de la Ley Nacional de Mecanismos Alternativos de Soluci&oacute;n de Controversias en Materia Penal</p><p>&nbsp;</p><p style="text-align: center;">[VICTIMA_NOMBRE]<br><strong>ACEPTO</strong></p>',
				'TEXTO' => 'En [DOCUMENTO_CIUDAD], Baja California, a [DOCUMENTO_FECHA], (él) (la) C. [VICTIMA_NOMBRE] quien se identifica con: [VICTIMA_TIPO_IDENTIFICACION], con número [VICTIMA_NUMERO_IDENTIFICACION], con domicilio en [VICTIMA_DOMICILIO], Teléfono casa: [VICTIMA_TELEFONO], Cel. [VICTIMA_TELEFONO_CELULAR], Trabajo [VICTIMA_TELEFONO_CELULAR], edad [VICTIMA_EDAD], Oficio [VICTIMA_OCUPACION], Nacionalidad [VICTIMA_NACIONALIDAD], Estado Civil [VICTIMA_ESTADO_CIVIL], manifiesto: Que entiendo y acepto los servicios que me ofrece el CENTRO DE DENUNCIA TECNOLÓGICA; con la finalidad de llevar a cabo el procedimiento de mediación, ACEPTO participar voluntariamente al mismo, para abordar un conflicto con: [IMPUTADO_NOMBRE]. Asimismo, manifiesto que se me ha informado acerca de los derechos, obligaciones, características y reglas del procedimiento, mismos que se encuentran establecidos en la Ley Nacional de Mecanismos Alternativos de Solución de Controversias en Materia Penal y Código Nacional de Procedimientos Penales, habiendo recibido a demás copia simple del presente documento; De igual forma manifiesto mi obligación  de INFORMAR INMEDIATAMENTE CUANDO DESEE dar por concluido el Procedimiento Alterno, según el artículo 32 de la Ley Nacional de Mecanismos Alternativos de Solución de Controversias en Materia Penal.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1614,
				'CLASIFICACIONDOCTOMEXICALIID' => 1508,
				'PLANTILLAJUSTICIATIJUANAID' => 1614,
				'CLASIFICACIONDOCTOTIJUANAID' => 1508,
				'PLANTILLAJUSTICIAENSENADAID' => 1614,
				'CLASIFICACIONDOCTOENSENADAID' => 1508,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'AUTORIZACION DE LA APLICACION DEL CRITERIO DE OPORTUNIDAD',
				'PLACEHOLDER' => '<p style="text-align: center;"><strong>AUTORIZACI&Oacute;N DE LA APLICACI&Oacute;N DEL CRITERIO DE OPORTUNIDAD</strong></p><p>&nbsp;</p><p style="text-align: right;"><strong>No.&nbsp;de Caso: [EXPEDIENTE_NUMERO]</strong></p><p>&nbsp;</p><table style="border-collapse: collapse; width: 100%;" border="2"><colgroup><col style="width: 100%;"></colgroup><tbody><tr><td><p>Lugar: [DOCUMENTO_CIUDAD], BAJA CALIFORNIA</p><p>Fecha:&nbsp; [DIA] de [MES] del [ANO], Hora: [HORA]: [MINUTOS]</p><p>Unidad de Investigaci&oacute;n: CENTRO DE DENUNCIA TECNOL&Oacute;GICA</p><p>Agente del Ministerio Publico: [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</p></td></tr></tbody></table><p>&nbsp;</p><p style="text-align: justify;">&nbsp; &nbsp; &nbsp;En [DOCUMENTO_CIUDAD], BAJA CALIFORNIA siendo las [HORA]: [MINUTOS], del d&iacute;a [DIA] DIAS DEL MES DE [MES] DEL A&Ntilde;O [ANO],&nbsp; analizadas las actuaciones que obran en la presente carpeta de investigaci&oacute;n iniciada por el delito de [DELITO_NOMBRE], (el) (la) suscrita (o)&nbsp; Lic.[EXPEDIENTE_NOMBRE_MP_RESPONSABLE], AGENTE DEL MINISTERIO P&Uacute;BLICO DEL CENTRO DE DENUNCIA TECNOL&Oacute;GICA, determina que resulta procedente aplicar un Criterio de Oportunidad con fundamento en lo establecido en la fracci&oacute;n (&nbsp; &nbsp; )&nbsp; del art&iacute;culo 256 del C&oacute;digo Nacional de Procedimientos Penales, adem&aacute;s de que se deber&aacute; contar con la autorizaci&oacute;n del Fiscal o por el servidor p&uacute;blico en quien est&eacute; delegada dicha facultad, por lo que de conformidad a lo establecido en el Acuerdo&nbsp; n&uacute;mero 01/2017, emitido para tal efecto por la C. Procuradora General de Justicia del Estado publicado en fecha&nbsp; 19 de Mayo&nbsp; de&nbsp; 2017 en el Peri&oacute;dico Oficial del Estado de Baja California;&nbsp; se delega dicha facultad en (la) (el) C. LIC. ___________,&nbsp; ENCARGADA DEL CENTRO DE DENUNCIA TECNOL&Oacute;GICA, atento a lo anterior, se solicita de no existir impedimento legal alguno, la autorizaci&oacute;n correspondiente.</p><p>&nbsp;</p><p style="text-align: left;">Agente del ministerio p&uacute;blico<br>[EXPEDIENTE_NOMBRE_MP_RESPONSABLE]</p><p>&nbsp;</p><p style="text-align: center;">Firma del que autoriza</p><p style="text-align: center;">LIC. (LIC ENCARGADO DEL CENTRO)<br>ENCARGADO DEL CENTRO DE DENUNCIA TECNOL&Oacute;GICA</p>',
				'TEXTO' => 'En [DOCUMENTO_CIUDAD], BAJA CALIFORNIA siendo las [HORA]: [MINUTOS], del día [DIA] DIAS DEL MES DE [MES] DEL AÑO [ANO],  analizadas las actuaciones que obran en la presente carpeta de investigación iniciada por el delito de [DELITO_NOMBRE], (el) (la) suscrita (o)  Lic.[EXPEDIENTE_NOMBRE_MP_RESPONSABLE], AGENTE DEL MINISTERIO PÚBLICO DEL CENTRO DE DENUNCIA TECNOLÓGICA, determina que resulta procedente aplicar un Criterio de Oportunidad con fundamento en lo establecido en la fracción (    )  del artículo 256 del Código Nacional de Procedimientos Penales, además de que se deberá contar con la autorización del Fiscal o por el servidor público en quien esté delegada dicha facultad, por lo que de conformidad a lo establecido en el Acuerdo  número 01/2017, emitido para tal efecto por la C. Procuradora General de Justicia del Estado publicado en fecha  19 de Mayo  de  2017 en el Periódico Oficial del Estado de Baja California;  se delega dicha facultad en (la) (el) C. LIC. ___________,  ENCARGADA DEL CENTRO DE DENUNCIA TECNOLÓGICA, atento a lo anterior, se solicita de no existir impedimento legal alguno, la autorización correspondiente.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1695,
				'CLASIFICACIONDOCTOMEXICALIID' => 1573,
				'PLANTILLAJUSTICIATIJUANAID' => 1695,
				'CLASIFICACIONDOCTOTIJUANAID' => 1573,
				'PLANTILLAJUSTICIAENSENADAID' => 1644,
				'CLASIFICACIONDOCTOENSENADAID' => 1567,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'CONSTANCIA DE EXTRAVIO',
				'PLACEHOLDER' => '<p style="text-align: right; color: #000000;"><strong>FOLIO: [FOLIO_NUMERO]/[ANIO]</strong></p><p style="text-align: justify; color: #000000;">El LIC. <strong>[NOMBRE_AGENTE_FIRMA]</strong>.</p><p style="text-align: justify; color: #000000;"></p><p style="text-align: justify; color: #000000;">HACE CONSTAR QUE EN EL CONTROL DE REPORTES QUE SE LLEV&Oacute; A CABO EN ESTA OFICINA, HA QUEDADO LA PERDIDA DE: <strong>[NOMBRE_CERTIFICADO]</strong>, OCURRIENDO BAJO LAS SIGUIENTES CIRCUNSTANCIAS.</p><p style="text-align: justify; color: #000000;"></p><p style="text-align: justify; color: #000000;">MANIFIESTA EL COMPARECIENTE HABER EXTRAVIADO EL ORIGINAL DE <strong>[NOMBRE_CERTIFICADO]</strong>, N&Uacute;MERO: <strong>[NO_DOCUMENTO]</strong>, A NOMBRE DE: <strong>[NOMBRE_DUENO]</strong>.</p><table class="t1" style="border-collapse: collapse; margin-left: auto; margin-right: auto; word-wrap: break-word; width: 100%;" bordercolor="#000000"><tbody><tr style="border: 2px solid black; margin: 0;"><td style="border: 2px solid black; margin: 0; padding: 5px; width: 25%;">COMPARECIENTE</td><td style="border: 2px solid black; margin: 0; padding: 5px;"><strong>[NOMBRE_COMPARECIENTE]</strong></td></tr><tr style="border: 2px solid black; margin: 0;"><td style="border: 2px solid black; margin: 0; padding: 5px; width: 25%;">DOMICILIO</td><td style="border: 2px solid black; margin: 0; padding: 5px;"><strong>[DOMICILIO_COMPARECIENTE]</strong></td></tr><tr style="border: 2px solid black; margin: 0;"><td style="border: 2px solid black; margin: 0; padding: 5px; width: 25%;">LUGAR DE EXTRAV&Iacute;O</td><td style="border: 2px solid black; margin: 0; padding: 5px;"><strong>[LUGAR_EXTRAVIO]</strong></td></tr><tr style="border: 2px solid black; margin: 0;"><td style="border: 2px solid black; margin: 0; padding: 5px; width: 25%;">FECHA DE EXTRAV&Iacute;O</td><td style="border: 2px solid black; margin: 0; padding: 5px;"><strong>[FECHA_EXTRAVIO]</strong></td></tr><tr style="border: 2px solid black; margin: 0;"><td style="border: 2px solid black; margin: 0; padding: 5px; width: 25%;">DESCRIPCI&Oacute;N</td><td style="border: 2px solid black; margin: 0; padding: 5px;"><strong>[DESCRIPCION_EXTRAVIO]</strong></td></tr></tbody></table><p></p><p style="text-align: justify; margin: 0px; color: #000000;">SE EXPIDE LA PRESENTE CONSTANCIA EN LA CIUDAD DE: <strong>[NOMBRE_CIUDAD]</strong> A LOS <strong>[DIA]</strong> D&Iacute;AS DEL MES DE <strong>[MES]</strong> DEL A&Ntilde;O <strong>[ANIO_FIRMA]</strong> A LAS <strong>[HORA]</strong>; LA CUAL NO SUSTITUYE EL DOCUMENTO ORIGINAL NI VALIDA LA PREEXISTENCIA DEL DOCUMENTO U OBJETO</p><p></p><p style="text-align: center; margin: 0px; color: #000000;"><strong>[NOMBRE_AGENTE_FIRMA]</strong><br />PERSONAL ADSCRITO AL</p><p style="text-align: center; margin: 0px; color: #000000;">CENTRO DE DENUCIA TECNOL&Oacute;GICA DE LA</p><p style="text-align: center; margin: 0px; color: #000000;">FISCALIA GENERAL DEL ESTADO DE BAJA CALIFORNIA</p><p></p><div><p style="text-align: center; color: #000000; background-color: #959393; padding: 10px; margin: 0px;"><span style="color: #ffffff;"><strong>DATOS FIRMA ELECTR&Oacute;NICA</strong></span></p></div><div style="display: flex; flex-direction: row; flex-wrap: wrap;"><div style="width: 70%; float: left;"><br /><p style="text-align: left; margin: 0px;"><strong>IDENTIFICADOR ELECTR&Oacute;NICO:</strong> [NUMEROIDENTIFICADOR]</p><p style="text-align: left; margin: 0px;"><strong>NOMBRE:</strong> [NOMBRE_AGENTE_FIRMA]</p><p style="text-align: left; margin: 0px;"><strong>RFC:</strong> [RFCFIRMA_FIRMA]</p><p style="text-align: left; margin: 0px;"><strong>NO. DE CERTIFICACI&Oacute;N: </strong>[NCERTIFICADOFIRMA]</p><p style="text-align: left; margin: 0px;"><strong>FECHA:</strong> [FECHAFIRMA]</p><p style="text-align: left; margin: 0px;"><strong>HORA:</strong> [HORAFIRMA]</p><p style="text-align: left; margin: 0px;"><strong>LUGAR:</strong> [LUGARFIRMA]</p><p style="text-align: left; margin: 0px;"></p></div><div style="width: 25%; float: right; word-wrap: break-word;"><br /><p style="text-align: center; margin: 0px;">[CODIGO_QR_1]</p><p style="text-align: center; margin: 0px;">[URL]</p></div></div><div style="display: flex; flex-direction: row; flex-wrap: wrap; word-wrap: break-word;"><div style="width: 30%;"><p style="text-align: left; margin: 0px;"><strong>FIRMA ELECTR&Oacute;NICA</strong></p></div><div style="width: 100%;"><p style="text-align: justify; margin: 0px;">[FIRMAELECTRONICA]</p></div></div><div style="float: left;"><p style="text-align: left; margin: 0px;">[CODIGO_QR_2]</p></div>',
				'TEXTO' => 'El LIC. [NOMBRE_AGENTE_FIRMA]. HACE CONSTAR QUE EN EL CONTROL DE REPORTES QUE SE LLEVÓ A CABO EN ESTA OFICINA, HA QUEDADO LA PERDIDA DE: [NOMBRE_CERTIFICADO], OCURRIENDO BAJO LAS SIGUIENTES CIRCUNSTANCIAS|MANIFIESTA EL COMPARECIENTE HABER EXTRAVIADO EL ORIGINAL DE [NOMBRE_CERTIFICADO], NÚMERO: [NO_DOCUMENTO], A NOMBRE DE: [NOMBRE_DUENO]|COMPARECIENTE [NOMBRE_COMPARECIENTE]|DOMICILIO [DOMICILIO_COMPARECIENTE]|LUGAR DE EXTRAVÍO [LUGAR_EXTRAVIO]|FECHA DE EXTRAVÍO [FECHA_EXTRAVIO]|DESCRIPCION [DESCRIPCION_EXTRAVIO]|SE EXPIDE LA PRESENTE CONSTANCIA EN LA CIUDAD DE: [NOMBRE_CIUDAD] A LOS [DIA] DÍAS DEL MES DE [MES] DEL AÑO [ANIO_FIRMA] A LAS [HORA]; LA CUAL NO SUSTITUYE EL DOCUMENTO ORIGINAL NI VALIDA LA PREEXISTENCIA DEL DOCUMENTO U OBJETO.',
				'PLANTILLAJUSTICIAMEXICALIID' => NULL,
				'CLASIFICACIONDOCTOMEXICALIID' => NULL,
				'PLANTILLAJUSTICIATIJUANAID' => NULL,
				'CLASIFICACIONDOCTOTIJUANAID' => NULL,
				'PLANTILLAJUSTICIAENSENADAID' => NULL,
				'CLASIFICACIONDOCTOENSENADAID' => NULL,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'COMISION EJECUTIVA ESTATAL DE ATENCION A VICTIMAS',
				'PLACEHOLDER' => '<p style="text-align: center;"><span><strong>COMISI&Oacute;N EJECUTIVA ESTATAL DE ATENCI&Oacute;N INTEGRAL A V&Iacute;CTIMAS<br></strong><span style="font-size: 10px;"><strong>(Art. 7 fracc. V de la Ley de Atenci&oacute;n y Protecci&oacute;n a la V&iacute;ctima o el Ofendido del Delito del Edo. y 86 fracci&oacute;n XVI del Reglamento de la Ley Org&aacute;nica de la FGJEBC.)</strong></span></span></p><p>&nbsp;</p><p style="text-align: right;"><span><strong>FICHA DE CANALIZACI&Oacute;N A V&Iacute;CTIMAS DEL DELITO<br></strong><strong>FECHA:<span class="Apple-converted-space">&nbsp; </span>[DIA] DE [MES] DEL [ANO]</strong></span></p><p>&nbsp;</p><p style="text-align: left;"><span><strong>1.- DATOS GENERALES<br><br></strong>NOMBRE: [VICTIMA_NOMBRE]</span><br><span>EDAD: [VICTIMA_EDAD] A&Ntilde;OS DE EDAD</span><br><span>DOMICILIO: [VICTIMA_DOMICILIO_COMPLETO]</span><br><span>TEL&Eacute;FONO: [VICTIMA_TELEFONO]</span><br><span>NUC: [EXPEDIENTE_NUMERO]</span><br><span>DELITO: [DELITO_NOMBRE]</span></p><p style="text-align: left;">&nbsp;</p><p style="text-align: left;"><span><strong>2.- INSTITUCI&Oacute;N QUE CANALIZA: CENTRO DE DENUNCIA TECNOL&Oacute;GICA<br><br></strong>MOTIVO DE LA CANALIZACI&Oacute;N: [DELITO_NOMBRE]</span><br><span>NOMBRE DEL QUE REFIERE: [EXPEDIENTE_NOMBRE_MP_RESPONSABLE]</span></p><p style="text-align: left;">&nbsp;</p><p style="text-align: left;"><span><strong>3.- DOMICILIO:<br><br></strong>[REMISION_DOMICILIO]</span></p><p>&nbsp;</p><p style="text-align: center;"><span>LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span><br><span>AGENTE DEL MINISTERIO P&Uacute;BLICO</span><br><span>ADSCRITO AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA</span></p>',
				'TEXTO' => '1.- DATOS GENERALESNOMBRE: [VICTIMA_NOMBRE]EDAD: [VICTIMA_EDAD] AÑOS DE EDADDOMICILIO: [VICTIMA_DOMICILIO_COMPLETO]TELÉFONO: [VICTIMA_TELEFONO]NUC: [EXPEDIENTE_NUMERO]DELITO: [DELITO_NOMBRE]2.- INSTITUCIÓN QUE CANALIZA: CENTRO DE DENUNCIA TECNOLÓGICAMOTIVO DE LA CANALIZACIÓN: [DELITO_NOMBRE]NOMBRE DEL QUE REFIERE: [EXPEDIENTE_NOMBRE_MP_RESPONSABLE]3.- DOMICILIO:[REMISION_DOMICILIO]',
				'PLANTILLAJUSTICIAMEXICALIID' => NULL,
				'CLASIFICACIONDOCTOMEXICALIID' => NULL,
				'PLANTILLAJUSTICIATIJUANAID' => NULL,
				'CLASIFICACIONDOCTOTIJUANAID' => NULL,
				'PLANTILLAJUSTICIAENSENADAID' => NULL,
				'CLASIFICACIONDOCTOENSENADAID' => NULL,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'CONSTANCIA DE RECEPCION DE VIDEO DENUNCIA',
				'PLACEHOLDER' => '<p style="text-align: center;"><strong>CONSTANCIA DE RECEPCI&Oacute;N DE VIDEO DENUNCIA</strong></p><p>&nbsp;</p><p style="text-align: justify;">&nbsp; &nbsp; &nbsp;En [DOCUMENTO_MUNICIPIO], Baja California, a los [DIA] d&iacute;as del mes de [MES] del a&ntilde;o [ANO], siendo las [HORA] horas con [MINUTOS] minutos, la/el suscrita (o) Licenciada(o) [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE], Agente del Ministerio P&uacute;blico adscrita(o) al Centro de Denuncia Tecnol&oacute;gica, hace constar que se inicia video denuncia interpuesta por la/el ciudadana (o) (VICTIMA Y/U OFENDIDO), quien manifiesta en su entrevista que &ldquo;(REDACTAR_HECHO)&ldquo;, motivo por el que refiere es su deseo presentar denuncia/querella por el delito de [RELACION_DELITO], previsto en el art&iacute;culo [NUMERO_CODIGO_PENAL] del C&oacute;digo Penal vigente en el Estado [ORDENAMIENTO_LEGAL] en contra de [IMPUTADO_NOMBRE], por tanto se genera [TIPO_EXPEDIENTE] [EXPEDIENTE_NUMERO], misma que ser&aacute; remitida a la Direcci&oacute;n de Zona [ZONA_SEJAP] para su debida remisi&oacute;n. Lo anterior de conformidad con el Art&iacute;culo 20 inciso C de la Constituci&oacute;n Pol&iacute;tica de los Estados Unidos Mexicanos, Art&iacute;culo 131 fracci&oacute;n II del C&oacute;digo Nacional de Procedimientos Penales,&nbsp; as&iacute; como el Art&iacute;culo 22, fracci&oacute;n II y dem&aacute;s aplicables de la Ley Org&aacute;nica de la Fiscal&iacute;a General del Estado de Baja California. CONSTE.</p><p style="text-align: left;">[INFORMACION_DEL_HECHO]</p>',
				'TEXTO' => 'En [DOCUMENTO_MUNICIPIO], Baja California, a los [DIA] días del mes de [MES] del año [ANO], siendo las [HORA] horas con [MINUTOS] minutos, la/el suscrita (o) Licenciada(o) [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE], Agente del Ministerio Público adscrita(o) al Centro de Denuncia Tecnológica, hace constar que se inicia video denuncia interpuesta por la/el ciudadana (o) (VICTIMA Y/U OFENDIDO), quien manifiesta en su entrevista que “(REDACTAR_HECHO)“, motivo por el que refiere es su deseo presentar denuncia/querella por el delito de [RELACION_DELITO], previsto en el artículo [NUMERO_CODIGO_PENAL] del Código Penal vigente en el Estado [ORDENAMIENTO_LEGAL] en contra de [IMPUTADO_NOMBRE], por tanto se genera [TIPO_EXPEDIENTE] [EXPEDIENTE_NUMERO], misma que será remitida a la Dirección de Zona [ZONA_SEJAP] para su debida remisión. Lo anterior de conformidad con el Artículo 20 inciso C de la Constitución Política de los Estados Unidos Mexicanos, Artículo 131 fracción II del Código Nacional de Procedimientos Penales,  así como el Artículo 22, fracción II y demás aplicables de la Ley Orgánica de la Fiscalía General del Estado de Baja California. CONSTE.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1767,
				'CLASIFICACIONDOCTOMEXICALIID' => 1655,
				'PLANTILLAJUSTICIATIJUANAID' => 1767,
				'CLASIFICACIONDOCTOTIJUANAID' => 1655,
				'PLANTILLAJUSTICIAENSENADAID' => 1712,
				'CLASIFICACIONDOCTOENSENADAID' => 1636,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'CRITERIO DE OPORTUNIDAD',
				'PLACEHOLDER' => '<p style="text-align: center;"><strong>CRITERIO DE OPORTUNIDAD</strong></p><p style="text-align: center;">&nbsp;</p><p style="text-align: right;"><strong>No.&nbsp;de Caso: [EXPEDIENTE_NUMERO]</strong></p><p style="text-align: right;">&nbsp;</p><table style="border-collapse: collapse; width: 100%;" border="2"><colgroup><col style="width: 100%;"></colgroup><tbody><tr><td><p>Lugar: [DOCUMENTO_CIUDAD], BAJA CALIFORNIA<br>Fecha:&nbsp; [DIA] de [MES] del [ANO], Hora: [HORA]: [MINUTOS]<br>Unidad de Investigaci&oacute;n: CENTRO DE DENUNCIA TECNOL&Oacute;GICA<br>Agente del Ministerio P&uacute;blico: [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</p></td></tr></tbody></table><p style="text-align: justify;">(La) (El) Ciudadana (o) Agente del Ministerio P&uacute;blico, Lic. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE], con fundamento en lo dispuesto por el p&aacute;rrafo s&eacute;ptimo del articulo 21 de la Constituci&oacute;n Pol&iacute;tica de los Estados Unidos Mexicanos, en relaci&oacute;n con el art&iacute;culo 131 Fracci&oacute;n XIV, 256, 257 y 258 del C&oacute;digo Nacional de Procedimientos Penales, as&iacute; como el art&iacute;culo 22 fracci&oacute;n XIV de la Ley Org&aacute;nica de la Fiscal&iacute;a General del Estado y conforme a los criterios generales dictados por el Procurador General de Justicia del Estado en el mes de mayo del a&ntilde;o del dos mil diecisiete, para la aplicaci&oacute;n de criterios de oportunidad, procede a consideraci&oacute;n del suscrito a llevar a cabo la aplicaci&oacute;n del mismo a favor de [IMPUTADO_NOMBRE], por la comisi&oacute;n del delito de [DELITO_NOMBRE], previsto por el art&iacute;culo [NUMERO_CODIGO_PENAL] del C&oacute;digo Penal en vigor en el Estado, cometido en agravio del de nombre [VICTIMA_NOMBRE].</p><p style="text-align: justify;">Lo anterior,&nbsp;toda vez que encuadra dentro del supuesto previsto en la fracci&oacute;n (&nbsp; ) del art&iacute;culo 256 del C&oacute;digo Nacional de Procedimientos Penales, el cual establece:</p><p style="text-align: justify;">Articulo 256.- Iniciada la Investigaci&oacute;n y previo an&aacute;lisis objetivo de los datos que consten en la misma, conforme a las disposiciones normativas de cada Procuradur&iacute;a, el Ministerio Publico, podr&aacute; abstenerse de ejercer la acci&oacute;n penal con base en la aplicaci&oacute;n de los criterios de oportunidad, siempre que, en su caso, se hayan reparado o garantizado los da&ntilde;os causados a la v&iacute;ctima u ofendido.</p><p style="text-align: justify;">La&nbsp;aplicaci&oacute;n de los criterios de oportunidad ser&aacute; procedente en cualquiera de los siguientes supuestos:</p><p style="text-align: justify;"><strong>I. </strong>Se trate de un delito que no tenga pena privativa de libertad, tenga pena alternativa o tenga pena privativa de libertad cuya punibilidad m&aacute;xima sea de cinco a&ntilde;os de prisi&oacute;n, siempre que el delito no se haya cometido con violencia;</p><p style="text-align: justify;"><strong>II. </strong>Se trate de delitos de contenido patrimonial cometidos sin violencia sobre las personas o de delitos culposos, siempre que el imputado no hubiere actuado en estado de ebriedad, bajo el influjo de narc&oacute;ticos o de cualquier otra sustancia que produzca efectos similares;</p><p style="text-align: justify;"><strong>III</strong>. Cuando el imputado haya sufrido como consecuencia directa del hecho delictivo un da&ntilde;o f&iacute;sico o psicoemocional grave, o cuando el imputado haya contra&iacute;do una enfermedad terminal que torne notoriamente innecesaria o desproporcional la aplicaci&oacute;n de una pena;</p><p style="text-align: justify;"><strong>IV.&nbsp;</strong>La pena o medida de seguridad que pudiera imponerse por el hecho delictivo que carezca de importancia en consideraci&oacute;n a la pena o medida de seguridad ya impuesta o a la que podr&iacute;a imponerse por otro delito por el que est&eacute; siendo procesado con independencia del fuero;</p><p style="text-align: justify;"><strong>V.&nbsp;</strong>Cuando el imputado aporte informaci&oacute;n esencial y eficaz para la persecuci&oacute;n de un delito m&aacute;s grave del que se le imputa, y se comprometa a comparecer en juicio;</p><p style="text-align: justify;"><strong>VI.&nbsp;</strong>Cuando, a raz&oacute;n de las causas o circunstancias que rodean la comisi&oacute;n de la conducta punible, resulte desproporcionada o irrazonable la persecuci&oacute;n penal.</p><p style="text-align: justify;">Se&ntilde;alando que de los hechos narrados por el denunciante [VICTIMA_NOMBRE]<strong>,</strong>&nbsp; se desprende que:&nbsp; [HECHO]</p><p style="text-align: justify;">&nbsp;</p><p style="text-align: justify;">(Narraci&oacute;n Breve de los hechos denunciados y motivaci&oacute;n de la determinaci&oacute;n)</p><p style="text-align: justify;">&nbsp;</p><p style="text-align: justify;">Aunado a lo expuesto y tomando en consideraci&oacute;n que hasta este momento no se ha dictado auto de apertura a juicio y valoradas que fueron las manifestaciones de la v&iacute;ctima del presente caso en particular, a juicio del suscrito existen elementos suficientes para determinar en el presente caso prescindir de la acci&oacute;n penal a favor de [IMPUTADO_NOMBRE]<strong>.</strong></p><p style="text-align: justify;">Lo anterior&nbsp;se le hace de conocimiento al denunciante [VICTIMA_NOMBRE], adem&aacute;s se le informa que cuenta con un plazo de <strong>Diez D&iacute;as</strong> posteriores a partir de la presente notificaci&oacute;n para efectos de comparecer ante el Juez de Control, en caso de que considere que la presente determinaci&oacute;n no se encuentra ajustada a derecho o constituye una discriminaci&oacute;n hacia su persona, lo anterior con fundamento en lo dispuesto por el art&iacute;culo 258 del C&oacute;digo Nacional de Procedimientos Penales.</p><p style="text-align: justify;">Finalmente, con fundamento en lo dispuesto en el &uacute;ltimo p&aacute;rrafo del art&iacute;culo 256 del C&oacute;digo Nacional de Procedimientos Penales, previa autorizaci&oacute;n de&nbsp;(nombre de quien autoriza).</p><p style="text-align: center;">&nbsp;</p><p style="text-align: center;">LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]<br>AGENTE DEL MINISTERIO PUBLICO CON ADSCRIPCI&Oacute;N <br>AL CENTRO DE DENUNCIA TECN&Oacute;LOGICA</p>',
				'TEXTO' => '(La) (El) Ciudadana (o) Agente del Ministerio Público, Lic. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE], con fundamento en lo dispuesto por el párrafo séptimo del articulo 21 de la Constitución Política de los Estados Unidos Mexicanos, en relación con el artículo 131 Fracción XIV, 256, 257 y 258 del Código Nacional de Procedimientos Penales, así como el artículo 22 fracción XIV de la Ley Orgánica de la Fiscalía General del Estado y conforme a los criterios generales dictados por el Procurador General de Justicia del Estado en el mes de mayo del año del dos mil diecisiete, para la aplicación de criterios de oportunidad, procede a consideración del suscrito a llevar a cabo la aplicación del mismo a favor de [IMPUTADO_NOMBRE], por la comisión del delito de [DELITO_NOMBRE], previsto por el artículo [NUMERO_CODIGO_PENAL] del Código Penal en vigor en el Estado, cometido en agravio del de nombre [VICTIMA_NOMBRE]. Lo anterior, toda vez que encuadra dentro del supuesto previsto en la fracción (  ) del artículo 256 del Código Nacional de Procedimientos Penales, el cual establece: Articulo 256.- Iniciada la Investigación y previo análisis objetivo de los datos que consten en la misma, conforme a las disposiciones normativas de cada Procuraduría, el Ministerio Publico, podrá abstenerse de ejercer la acción penal con base en la aplicación de los criterios de oportunidad, siempre que, en su caso, se hayan reparado o garantizado los daños causados a la víctima u ofendido. La aplicación de los criterios de oportunidad será procedente en cualquiera de los siguientes supuestos: La aplicación de los criterios de oportunidad será procedente en cualquiera de los siguientes supuestos: I. Se trate de un delito que no tenga pena privativa de libertad, tenga pena alternativa o tenga pena privativa de libertad cuya punibilidad máxima sea de cinco años de prisión, siempre que el delito no se haya cometido con violencia; II. Se trate de delitos de contenido patrimonial cometidos sin violencia sobre las personas o de delitos culposos, siempre que el imputado no hubiere actuado en estado de ebriedad, bajo el influjo de narcóticos o de cualquier otra sustancia que produzca efectos similares; III. Cuando el imputado haya sufrido como consecuencia directa del hecho delictivo un daño físico o psicoemocional grave, o cuando el imputado haya contraído una enfermedad terminal que torne notoriamente innecesaria o desproporcional la aplicación de una pena; IV. La pena o medida de seguridad que pudiera imponerse por el hecho delictivo que carezca de importancia en consideración a la pena o medida de seguridad ya impuesta o a la que podría imponerse por otro delito por el que esté siendo procesado con independencia del fuero; V. Cuando el imputado aporte información esencial y eficaz para la persecución de un delito más grave del que se le imputa, y se comprometa a comparecer en juicio; VI. Cuando, a razón de las causas o circunstancias que rodean la comisión de la conducta punible, resulte desproporcionada o irrazonable la persecución penal. Señalando que de los hechos narrados por el denunciante [VICTIMA_NOMBRE],  se desprende que:  [HECHO] (Narración Breve de los hechos denunciados y motivación de la determinación) Aunado a lo expuesto y tomando en consideración que hasta este momento no se ha dictado auto de apertura a juicio y valoradas que fueron las manifestaciones de la víctima del presente caso en particular, a juicio del suscrito existen elementos suficientes para determinar en el presente caso prescindir de la acción penal a favor de [IMPUTADO_NOMBRE]. Lo anterior se le hace de conocimiento al denunciante [VICTIMA_NOMBRE], además se le informa que cuenta con un plazo de Diez Días posteriores a partir de la presente notificación para efectos de comparecer ante el Juez de Control, en caso de que considere que la presente determinación no se encuentra ajustada a derecho o constituye una discriminación hacia su persona, lo anterior con fundamento en lo dispuesto por el artículo 258 del Código Nacional de Procedimientos Penales. Finalmente, con fundamento en lo dispuesto en el último párrafo del artículo 256 del Código Nacional de Procedimientos Penales, previa autorización de ______ (nombre de quien autoriza.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1598,
				'CLASIFICACIONDOCTOMEXICALIID' => 1528,
				'PLANTILLAJUSTICIATIJUANAID' => 1598,
				'CLASIFICACIONDOCTOTIJUANAID' => 1528,
				'PLANTILLAJUSTICIAENSENADAID' => 1598,
				'CLASIFICACIONDOCTOENSENADAID' => 1528,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'FACULTAD DE ABSTENERSE DE INVESTIGAR (NO DELITO)',
				'PLACEHOLDER' => '<p style="text-align: center;"><span><strong>FACULTAD DE ABSTENERSE DE INVESTIGAR<br></strong>(NO DELITO)</span></p><p style="text-align: right;"><span><strong>No.&nbsp;de Caso: [EXPEDIENTE_NUMERO]</strong></span></p><table style="border-collapse: collapse; width: 100%;" border="2"><colgroup><col style="width: 100%;"></colgroup><tbody><tr><td><p><span>Lugar: [DOCUMENTO_CIUDAD], BAJA CALIFORNIA</span><br><span>Fecha:&nbsp; [DIA] de [MES] del [ANO], Hora: [HORA]: [MINUTOS]</span><br><span>Unidad de Investigaci&oacute;n: CENTRO DE DENUNCIA TECNOL&Oacute;GICA</span><br><span>Agente del Ministerio Publico: [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span></p></td></tr></tbody></table><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Vistos y analizados todos y cada uno de los antecedentes que conforman&nbsp; la presente carpeta de investigaci&oacute;n y toda vez que no se ha celebrado la audiencia inicial referida en el art&iacute;culo 307 del C&oacute;digo Nacional de Procedimientos Penales en vigor ni se ha formulado imputaci&oacute;n por parte de esta Representaci&oacute;n Social, con fundamento en el art&iacute;culo <strong>253</strong> del C&oacute;digo Nacional de Procedimientos Penales, la/el suscrita (o) Agente del Ministerio P&uacute;blico licenciada (o) [EXPEDIENTE_NOMBRE_MP_RESPONSABLE],&nbsp; procede aplicar la Facultad de Abstenerse de Investigar en el caso que nos ocupa, en relaci&oacute;n con lo dispuesto en el art&iacute;culo 485&nbsp; Fracci&oacute;n&nbsp; VII del C&oacute;digo adjetivo de la materia, toda vez que de los hechos narrados por el ofendido (nombre) se desprende que: &nbsp;</span></p><p style="text-align: justify;"><span><strong>[HECHO]</strong>,</span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;En virtud de lo antes expuesto se decreta el no ejercicio penal en favor del imputado [IMPUTADO_NOMBRE], por la comisi&oacute;n del delito de [DELITO_NOMBRE], previsto y sancionado en el art&iacute;culo [NUMERO_CODIGO_PENAL] del C&oacute;digo Penal vigente en el Estado, por tanto se ordena que la presente carpeta de investigaci&oacute;n se remita al archivo definitivo como asunto total y definitivamente concluido. No obstante se le hace del conocimiento al denunciante [VICTIMA_NOMBRE] que cuenta con un plazo de Diez D&iacute;as posteriores a partir de que surta efectos la notificaci&oacute;n, para comparecer ante el Juez de Control, en caso de considerar que la presente determinaci&oacute;n no se encuentra ajustada a derecho o constituye una discriminaci&oacute;n hacia su persona, esto con fundamente en lo dispuesto por el art&iacute;culo 258 del C&oacute;digo Nacional de Procedimientos Penales.</span></p><p>&nbsp;</p><p style="text-align: center;"><span>LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span><br><span>AGENTE DEL MINISTERIO PUBLICO CON ADSCRIPCI&Oacute;N</span><br><span>AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA</span></p><p>&nbsp;</p>',
				'TEXTO' => 'Vistos y analizados todos y cada uno de los antecedentes que conforman  la presente carpeta de investigación y toda vez que no se ha celebrado la audiencia inicial referida en el artículo 307 del Código Nacional de Procedimientos Penales en vigor ni se ha formulado imputación por parte de esta Representación Social, con fundamento en el artículo 253 del Código Nacional de Procedimientos Penales, la/el suscrita (o) Agente del Ministerio Público licenciada (o) [EXPEDIENTE_NOMBRE_MP_RESPONSABLE],  procede aplicar la Facultad de Abstenerse de Investigar en el caso que nos ocupa, en relación con lo dispuesto en el artículo 485  Fracción  VII del Código adjetivo de la materia, toda vez que de los hechos narrados por el ofendido (nombre) se desprende que: [HECHO], En virtud de lo antes expuesto se decreta el no ejercicio penal en favor del imputado [IMPUTADO_NOMBRE], por la comisión del delito de [DELITO_NOMBRE], previsto y sancionado en el artículo [NUMERO_CODIGO_PENAL] del Código Penal vigente en el Estado, por tanto se ordena que la presente carpeta de investigación se remita al archivo definitivo como asunto total y definitivamente concluido. No obstante se le hace del conocimiento al denunciante [VICTIMA_NOMBRE] que cuenta con un plazo de Diez Días posteriores a partir de que surta efectos la notificación, para comparecer ante el Juez de Control, en caso de considerar que la presente determinación no se encuentra ajustada a derecho o constituye una discriminación hacia su persona, esto con fundamente en lo dispuesto por el artículo 258 del Código Nacional de Procedimientos Penales.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1638,
				'CLASIFICACIONDOCTOMEXICALIID' => 1555,
				'PLANTILLAJUSTICIATIJUANAID' => 1638,
				'CLASIFICACIONDOCTOTIJUANAID' => 1555,
				'PLANTILLAJUSTICIAENSENADAID' => 1638,
				'CLASIFICACIONDOCTOENSENADAID' => 1555,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'FACULTAD DE ABSTENERSE DE INVESTIGAR (PRESCRIPCION)',
				'PLACEHOLDER' => '<p style="text-align: center;"><span><strong>FACULTAD DE ABSTENERSE DE INVESTIGAR<br></strong>(ACCI&Oacute;N PENAL EXTINGUIDA)</span></p><p style="text-align: right;"><span><strong>No.&nbsp;de Caso: [EXPEDIENTE_NUMERO]</strong></span></p><p style="text-align: right;">&nbsp;</p><table style="border-collapse: collapse; width: 100%;" border="2"><colgroup><col style="width: 100%;"></colgroup><tbody><tr><td><p><span>Lugar: [DOCUMENTO_CIUDAD], BAJA CALIFORNIA</span><br><span>Fecha:&nbsp; [DIA] de [MES] del [ANO], Hora: [HORA]: [MINUTOS]</span><br><span>Unidad de Investigaci&oacute;n: CENTRO DE DENUNCIA TECNOL&Oacute;GICA</span><br><span>Agente del Ministerio Publico: [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span></p></td></tr></tbody></table><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Vistos y analizados todos y cada uno de los antecedentes que conforman&nbsp; la presente carpeta de investigaci&oacute;n y toda vez que no se ha celebrado la audiencia inicial referida en el art&iacute;culo 307 del C&oacute;digo Nacional de Procedimientos Penales en vigor ni se ha formulado imputaci&oacute;n por parte de esta Representaci&oacute;n Social, con fundamento en el art&iacute;culo <strong>253</strong> del C&oacute;digo Nacional de Procedimientos Penales, la/el suscrito Agente del Ministerio P&uacute;blico licenciada (o) [EXPEDIENTE_NOMBRE_MP_RESPONSABLE],&nbsp; procede aplicar la Facultad de Abstenerse de Investigar en el caso que nos ocupa, en relaci&oacute;n con lo dispuesto en el art&iacute;culo 485&nbsp; Fracci&oacute;n&nbsp; VII del C&oacute;digo adjetivo de la materia, toda vez que de los hechos narrados por la parte ofendida&nbsp; (nombre de denunciante) se desprende que: &nbsp;</span></p><p style="text-align: justify;"><span>(<strong>NARRACION</strong> <strong>BREVE DE LOS HECHOS DENUNCIADOS, Y MOTIVACION DE LA DETERMINACION</strong>).</span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;En virtud de lo anterior se advierte que&nbsp; desde la fecha en que ocurrieron los hechos materia de la presente investigaci&oacute;n y la fecha en que se act&uacute;a, ya pasaron m&aacute;s de (<strong>A&Ntilde;OS&nbsp; y DIAS TRANSCURRIDOS</strong>),&nbsp; sin que se haya presentado formal querella de parte ofendida, por lo que ha pasado en exceso el plazo para la interposici&oacute;n de la&nbsp; misma en el caso que nos ocupa, siendo un requisito fundamental para este tipo de delitos, como lo es un a&ntilde;o a partir de la comisi&oacute;n del delito,&nbsp; lo anterior en apego a los numerales 113 Fracci&oacute;n I&nbsp; en relaci&oacute;n con el 115&nbsp; del C&oacute;digo Penal para el Estado de Baja California, resultando procedente determinar que se ha extinguido la pretensi&oacute;n punitiva a favor del imputado&nbsp; [IMPUTADO_NOMBRE], ordenando se remita la presente carpeta de investigaci&oacute;n al Archivo Definitivo como asunto total y definitivamente concluido; debi&eacute;ndose notificar a la v&iacute;ctima o el ofendido en la presente carpeta de investigaci&oacute;n la resoluci&oacute;n respectiva.</span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Lo anterior se le hace de conocimiento al denunciante [VICTIMA_NOMBRE], adem&aacute;s se le informa que cuenta con un plazo de <strong>Diez D&iacute;as</strong> posteriores a partir de que surta efectos la notificaci&oacute;n, para comparecer ante el Juez de Control, en caso de que considere que la presente determinaci&oacute;n no se encuentra ajustada a derecho o constituye una discriminaci&oacute;n hacia su persona, lo anterior con fundamento en lo dispuesto por el art&iacute;culo 258 del C&oacute;digo Nacional de Procedimientos Penales.</span></p><p style="text-align: center;"><span>LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span><br><span>AGENTE DEL MINISTERIO PUBLICO CON ADSCRIPCI&Oacute;N</span><br><span>AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA</span></p>',
				'TEXTO' => 'Vistos y analizados todos y cada uno de los antecedentes que conforman  la presente carpeta de investigación y toda vez que no se ha celebrado la audiencia inicial referida en el artículo 307 del Código Nacional de Procedimientos Penales en vigor ni se ha formulado imputación por parte de esta Representación Social, con fundamento en el artículo 253 del Código Nacional de Procedimientos Penales, la/el suscrito Agente del Ministerio Público licenciada (o) [EXPEDIENTE_NOMBRE_MP_RESPONSABLE],  procede aplicar la Facultad de Abstenerse de Investigar en el caso que nos ocupa, en relación con lo dispuesto en el artículo 485  Fracción  VII del Código adjetivo de la materia, toda vez que de los hechos narrados por la parte ofendida  (nombre de denunciante) se desprende que: (NARRACION BREVE DE LOS HECHOS DENUNCIADOS, Y MOTIVACION DE LA DETERMINACION), En virtud de lo anterior se advierte que  desde la fecha en que ocurrieron los hechos materia de la presente investigación y la fecha en que se actúa, ya pasaron más de (AÑOS  y DIAS TRANSCURRIDOS),  sin que se haya presentado formal querella de parte ofendida, por lo que ha pasado en exceso el plazo para la interposición de la  misma en el caso que nos ocupa, siendo un requisito fundamental para este tipo de delitos, como lo es un año a partir de la comisión del delito,  lo anterior en apego a los numerales 113 Fracción I  en relación con el 115  del Código Penal para el Estado de Baja California, resultando procedente determinar que se ha extinguido la pretensión punitiva a favor del imputado  [IMPUTADO_NOMBRE], ordenando se remita la presente carpeta de investigación al Archivo Definitivo como asunto total y definitivamente concluido; debiéndose notificar a la víctima o el ofendido en la presente carpeta de investigación la resolución respectiva. Lo anterior se le hace de conocimiento al denunciante [VICTIMA_NOMBRE], además se le informa que cuenta con un plazo de Diez Días posteriores a partir de que surta efectos la notificación, para comparecer ante el Juez de Control, en caso de que considere que la presente determinación no se encuentra ajustada a derecho o constituye una discriminación hacia su persona, lo anterior con fundamento en lo dispuesto por el artículo 258 del Código Nacional de Procedimientos Penales.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1637,
				'CLASIFICACIONDOCTOMEXICALIID' => 1554,
				'PLANTILLAJUSTICIATIJUANAID' => 1637,
				'CLASIFICACIONDOCTOTIJUANAID' => 1554,
				'PLANTILLAJUSTICIAENSENADAID' => 1637,
				'CLASIFICACIONDOCTOENSENADAID' => 1554,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'NOTIFICACION DE DETERMINACION',
				'PLACEHOLDER' => '<p style="text-align: center;"><span><strong>NOTIFICACION DE DETERMINACION<br></strong>POR CORREO ELECTR&Oacute;NICO&nbsp;</span></p><p style="text-align: right;">&nbsp;</p><p style="text-align: right;"><span><strong>No. de Caso: [EXPEDIENTE_NUMERO]</strong></span></p><p><span><strong>C. [VICTIMA_NOMBRE]<br></strong><strong>[VICTIMA_CORREO]<br></strong>PRESENTE.-</span></p><p>&nbsp;</p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Por medio del presente se le notifica que en relaci&oacute;n al caso denunciado por usted dentro de la carpeta de investigaci&oacute;n [EXPEDIENTE_NUMERO], por el delito de [DELITO_NOMBRE] previsto en el art&iacute;culo [NUMERO_CODIGO_PENAL] del C&oacute;digo Penal vigente en el Estado, se determin&oacute; la aplicaci&oacute;n de un <strong>CRITERIO DE OPORTUNIDAD</strong>, lo anterior con fundamento en lo dispuesto por el p&aacute;rrafo s&eacute;ptimo del art&iacute;culo 21 de la Constituci&oacute;n Pol&iacute;tica de los Estados Unidos Mexicanos, en relaci&oacute;n con los art&iacute;culos 253, 255, 256, 258 y dem&aacute;s relativas del C&oacute;digo Nacional de Procedimientos Penales, as&iacute; como el diverso 22 fracci&oacute;n XIII y XIV de la Ley Org&aacute;nica de la Fiscal&iacute;a General del Estado de Baja California. Se adjunta al presente una copia de la determinaci&oacute;n en comento, inform&aacute;ndole que en caso considerar que tal resoluci&oacute;n no se ajuste a los requisitos formales o constituye discriminaci&oacute;n, podr&aacute; impugnarla para lo cual cuenta con un plazo de diez d&iacute;as posteriores a la recepci&oacute;n de este correo para comparecer ante el Juez de Control. &nbsp;</span></p><p style="text-align: justify;"><span>Sin&nbsp;otro particular por el momento, quedo a sus apreciables &oacute;rdenes.</span></p><p>&nbsp;</p><p style="text-align: center;"><span>[DOCUMENTO_CIUDAD], BAJA CALIFORNIA</span><br><span>[DOCUMENTO_FECHA]</span><br><br><span>LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span><br><span>AGENTE DEL MINISTERIO PUBLICO CON ADSCRIPCI&Oacute;N</span><br><span>AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA &nbsp;</span></p>',
				'TEXTO' => 'Por medio del presente se le notifica que en relación al caso denunciado por usted dentro de la carpeta de investigación [EXPEDIENTE_NUMERO], por el delito de [DELITO_NOMBRE] previsto en el artículo [NUMERO_CODIGO_PENAL] del Código Penal vigente en el Estado, se determinó la aplicación de un CRITERIO DE OPORTUNIDAD, lo anterior con fundamento en lo dispuesto por el párrafo séptimo del artículo 21 de la Constitución Política de los Estados Unidos Mexicanos, en relación con los artículos 253, 255, 256, 258 y demás relativas del Código Nacional de Procedimientos Penales, así como el diverso 22 fracción XIII y XIV de la Ley Orgánica de la Fiscalía General del Estado de Baja California. Se adjunta al presente una copia de la determinación en comento, informándole que en caso considerar que tal resolución no se ajuste a los requisitos formales o constituye discriminación, podrá impugnarla para lo cual cuenta con un plazo de diez días posteriores a la recepción de este correo para comparecer ante el Juez de Control. Sin otro particular por el momento, quedo a sus apreciables órdenes.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1639,
				'CLASIFICACIONDOCTOMEXICALIID' => 1556,
				'PLANTILLAJUSTICIATIJUANAID' => 1639,
				'CLASIFICACIONDOCTOTIJUANAID' => 1556,
				'PLANTILLAJUSTICIAENSENADAID' => 1636,
				'CLASIFICACIONDOCTOENSENADAID' => 1553,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'ORDEN DE PROTECCION (ALBERGUE TEMPORAL HOMBRE)',
				'PLACEHOLDER' => '<p style="text-align: right;"><span><strong>EXPEDIENTE: [EXPEDIENTE_NUMERO]</strong></span></p><p>&nbsp;</p><p><span>[DIRECCION_NOMBRE]</span><br><span>[DOCUMENTO_CIUDAD],BAJA CALIFORNIA</span><br><span>PRESENTE.-</span></p><p>&nbsp;</p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Por medio del presente, con fundamento en el art&iacute;culo 8 Fracc. VII de la Ley de Atenci&oacute;n y protecci&oacute;n a la V&iacute;ctima u Ofendido del Delito para el estado de Baja California,&nbsp; articulo 109 fracciones XVI, XVIII y XIX y art&iacute;culo 137&nbsp; en sus Fracc. IV, V, VI, VII, VIII, IX y X&nbsp; del C&oacute;digo Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protecci&oacute;n a la v&iacute;ctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la v&iacute;ctima de nombre&nbsp; [VICTIMA_NOMBRE] de [VICTIMA_EDAD] , con tel&eacute;fono de contacto&nbsp; [VICTIMA_TELEFONO] , para ser trasladada a las instalaciones del <strong>albergue temporal</strong> de CAVIM de esta ciudad, lo anterior con la finalidad de salvaguardar en todo momento su integridad f&iacute;sica, ya que presento denuncia por el delito de&nbsp; [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE]&nbsp; de [IMPUTADO_EDAD]. Sin m&aacute;s por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigaci&oacute;n correspondiente sobre las diligencias realizadas al respecto.</span></p><p>&nbsp;</p><p style="text-align: center;"><span>[DOCUMENTO_CIUDAD], BAJA CALIFORNIA, [DOCUMENTO_FECHA]</span><br><span>[EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span><br><span>AGENTE DEL MINISTERIO P&Uacute;BLICO</span><br><span>ADSCRITO AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA</span></p>',
				'TEXTO' => 'Por medio del presente, con fundamento en el artículo 8 Fracc. VII de la Ley de Atención y protección a la Víctima u Ofendido del Delito para el estado de Baja California,  articulo 109 fracciones XVI, XVIII y XIX y artículo 137  en sus Fracc. IV, V, VI, VII, VIII, IX y X  del Código Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la víctima de nombre  [VICTIMA_NOMBRE] de [VICTIMA_EDAD] , con teléfono de contacto  [VICTIMA_TELEFONO] , para ser trasladada a las instalaciones del albergue temporal de CAVIM de esta ciudad, lo anterior con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de  [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE]  de [IMPUTADO_EDAD]. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1624,
				'CLASIFICACIONDOCTOMEXICALIID' => 1540,
				'PLANTILLAJUSTICIATIJUANAID' => 1624,
				'CLASIFICACIONDOCTOTIJUANAID' => 1540,
				'PLANTILLAJUSTICIAENSENADAID' => 1624,
				'CLASIFICACIONDOCTOENSENADAID' => 1540,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'ORDEN DE PROTECCION (ALBERGUE TEMPORAL MUJER)',
				'PLACEHOLDER' => '<p style="text-align: right;"><strong>EXPEDIENTE: [EXPEDIENTE_NUMERO]</strong></p><p>&nbsp;</p><p>[DIRECCION_NOMBRE]<br>[DOCUMENTO_CIUDAD],BAJA CALIFORNIA<br>PRESENTE.-</p><p>&nbsp;</p><p style="text-align: justify;">&nbsp; &nbsp; &nbsp;Por medio del presente, con fundamento en los art&iacute;culos 21, 22, 23, 24, 25, 26 de la Ley de Acceso a las Mujeres a una Vida Libre de Violencia para el Estado de Baja California, art. 8 Fracc. VII&nbsp; de la Ley de Atenci&oacute;n y protecci&oacute;n a la V&iacute;ctimas u Ofendido&nbsp; del Delito para el estado de Baja California,&nbsp; articulo 109 fracciones XVI, XVIII y XIX y art&iacute;culo 137&nbsp; en sus Fracc. IV, V, VI, VII, VIII, IX y X&nbsp; del C&oacute;digo Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protecci&oacute;n a la v&iacute;ctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la v&iacute;ctima de nombre&nbsp; [VICTIMA_NOMBRE] de [VICTIMA_EDAD] , con tel&eacute;fono de contacto&nbsp; [VICTIMA_TELEFONO], para&nbsp;ser trasladada a las instalaciones del <strong>albergue temporal</strong> de CAVIM de esta ciudad, lo anterior con la finalidad de salvaguardar en todo momento su integridad f&iacute;sica, ya que presento denuncia por el delito de&nbsp; [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE]&nbsp; de [IMPUTADO_EDAD]. Sin m&aacute;s por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigaci&oacute;n correspondiente sobre las diligencias realizadas al respecto.</p><p>&nbsp;</p><p style="text-align: center;">[DOCUMENTO_CIUDAD], BAJA CALIFORNIA, [DOCUMENTO_FECHA<br>[EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]<br>AGENTE DEL MINISTERIO P&Uacute;BLICO<br>ADSCRITO AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA&nbsp;</p>',
				'TEXTO' => 'Por medio del presente, con fundamento en los artículos 21, 22, 23, 24, 25, 26 de la Ley de Acceso a las Mujeres a una Vida Libre de Violencia para el Estado de Baja California, art. 8 Fracc. VII  de la Ley de Atención y protección a la Víctimas u Ofendido  del Delito para el estado de Baja California,  articulo 109 fracciones XVI, XVIII y XIX y artículo 137  en sus Fracc. IV, V, VI, VII, VIII, IX y X  del Código Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la víctima de nombre  [VICTIMA_NOMBRE] de [VICTIMA_EDAD] , con teléfono de contacto  [VICTIMA_TELEFONO] , para ser trasladada a las instalaciones del albergue temporal de CAVIM de esta ciudad, lo anterior con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de  [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE]  de [IMPUTADO_EDAD]. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1624,
				'CLASIFICACIONDOCTOMEXICALIID' => 1540,
				'PLANTILLAJUSTICIATIJUANAID' => 1624,
				'CLASIFICACIONDOCTOTIJUANAID' => 1540,
				'PLANTILLAJUSTICIAENSENADAID' => 1624,
				'CLASIFICACIONDOCTOENSENADAID' => 1540,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'ORDEN DE PROTECCION (RECOGER PERTENENCIAS HOMBRE)',
				'PLACEHOLDER' => '<p style="text-align: right;"><span><strong>EXPEDIENTE: [EXPEDIENTE_NUMERO]</strong></span></p><p>&nbsp;</p><p><span>DIRECCI&Oacute;N DE SEGURIDAD P&Uacute;BLICA MUNICIPAL</span><br><span>[DOCUMENTO_CIUDAD],BAJA CALIFORNIA</span><br><span>PRESENTE.-</span></p><p>&nbsp;</p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Por medio del presente, con fundamento en el art&iacute;culo 8 Fracc. VII de la Ley de Atenci&oacute;n y protecci&oacute;n a la V&iacute;ctima u Ofendido&nbsp; del Delito para el estado de Baja California,&nbsp; articulo 109 fracciones XVI, XVIII y XIX y art&iacute;culo 137&nbsp; en sus Fracc. IV, V, VI, VII, VIII, IX y X&nbsp; del C&oacute;digo Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protecci&oacute;n a la v&iacute;ctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la victima de nombre&nbsp; [VICTIMA_NOMBRE] de [VICTIMA_EDAD] , con telefono de contacto&nbsp; [VICTIMA_TELEFONO] , para ser trasladada al domicilio ubicado [VICTIMA_DOMICILIO] y se encuentre en la posibilidad de <strong>recoger pertenencias</strong>, lo anterior con la finalidad de salvaguardar en todo momento su integridad f&iacute;sica, ya que presento denuncia por el delito de&nbsp; [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE]&nbsp; de [IMPUTADO_EDAD]. Sin m&aacute;s por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigaci&oacute;n correspondiente sobre las diligencias realizadas al respecto.</span></p><p>&nbsp;</p><p style="text-align: center;"><span>[DOCUMENTO_CIUDAD], BAJA CALIFORNIA, [DOCUMENTO_FECHA</span><br><span>[EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span><br><span>AGENTE DEL MINISTERIO P&Uacute;BLICO</span><br><span>ADSCRITO AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA</span></p>',
				'TEXTO' => 'Por medio del presente, con fundamento en el artículo 8 Fracc. VII de la Ley de Atención y protección a la Víctima u Ofendido  del Delito para el estado de Baja California,  articulo 109 fracciones XVI, XVIII y XIX y artículo 137  en sus Fracc. IV, V, VI, VII, VIII, IX y X  del Código Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la victima de nombre  [VICTIMA_NOMBRE] de [VICTIMA_EDAD] , con telefono de contacto  [VICTIMA_TELEFONO] , para ser trasladada al domicilio ubicado [VICTIMA_DOMICILIO] y se encuentre en la posibilidad de recoger pertenencias, lo anterior con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de  [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE]  de [IMPUTADO_EDAD]. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1670,
				'CLASIFICACIONDOCTOMEXICALIID' => 1647,
				'PLANTILLAJUSTICIATIJUANAID' => 1670,
				'CLASIFICACIONDOCTOTIJUANAID' => 1647,
				'PLANTILLAJUSTICIAENSENADAID' => 1705,
				'CLASIFICACIONDOCTOENSENADAID' => 1627,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'ORDEN DE PROTECCION (RECOGER PERTENENCIAS MUJER)',
				'PLACEHOLDER' => '<p style="text-align: right;"><span><strong>EXPEDIENTE: [EXPEDIENTE_NUMERO]</strong></span></p><p>&nbsp;</p><p><span>DIRECCI&Oacute;N DE SEGURIDAD P&Uacute;BLICA MUNICIPAL</span><br><span>[DOCUMENTO_CIUDAD],BAJA CALIFORNIA</span><br><span>PRESENTE.-</span></p><p>&nbsp;</p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Por medio del presente, con fundamento en los art&iacute;culos 21, 22, 23, 24, 25, 26 de la Ley de Acceso a las Mujeres a una Vida Libre de Violencia para el Estado de Baja California, art. 8 Fracc. VII&nbsp; de la Ley de Atenci&oacute;n y protecci&oacute;n a la V&iacute;ctimas u Ofendido&nbsp; del Delito para el estado de Baja California,&nbsp; articulo 109 fracciones XVI, XVIII y XIX y art&iacute;culo 137&nbsp; en sus Fracc. IV, V, VI, VII, VIII, IX y X&nbsp; del C&oacute;digo Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protecci&oacute;n a la v&iacute;ctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la victima de nombre&nbsp; [VICTIMA_NOMBRE] de [VICTIMA_EDAD] , con telefono de contacto&nbsp; [VICTIMA_TELEFONO] , para ser trasladada al domicilio ubicado [VICTIMA_DOMICILIO] y se encuentre en la posibilidad de <strong>recoger pertenencias</strong>, lo anterior con la finalidad de salvaguardar en todo momento su integridad f&iacute;sica, ya que presento denuncia por el delito de&nbsp; [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE]&nbsp; de [IMPUTADO_EDAD]. Sin m&aacute;s por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigaci&oacute;n correspondiente sobre las diligencias realizadas al respecto.</span></p><p>&nbsp;</p><p style="text-align: center;"><span>[DOCUMENTO_CIUDAD], BAJA CALIFORNIA, [DOCUMENTO_FECHA<br>[EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span><br><span>AGENTE DEL MINISTERIO P&Uacute;BLICO</span><br><span>ADSCRITO AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA</span></p>',
				'TEXTO' => 'Por medio del presente, con fundamento en los artículos 21, 22, 23, 24, 25, 26 de la Ley de Acceso a las Mujeres a una Vida Libre de Violencia para el Estado de Baja California, art. 8 Fracc. VII  de la Ley de Atención y protección a la Víctimas u Ofendido  del Delito para el estado de Baja California,  articulo 109 fracciones XVI, XVIII y XIX y artículo 137  en sus Fracc. IV, V, VI, VII, VIII, IX y X  del Código Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la victima de nombre  [VICTIMA_NOMBRE] de [VICTIMA_EDAD] , con telefono de contacto  [VICTIMA_TELEFONO] , para ser trasladada al domicilio ubicado [VICTIMA_DOMICILIO] y se encuentre en la posibilidad de recoger pertenencias, lo anterior con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de  [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE]  de [IMPUTADO_EDAD]. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1622,
				'CLASIFICACIONDOCTOMEXICALIID' => 1541,
				'PLANTILLAJUSTICIATIJUANAID' => 1622,
				'CLASIFICACIONDOCTOTIJUANAID' => 1541,
				'PLANTILLAJUSTICIAENSENADAID' => 1622,
				'CLASIFICACIONDOCTOENSENADAID' => 1541,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'ORDEN DE PROTECCION (REALICEN RONDINES HOMBRE)',
				'PLACEHOLDER' => '<p style="text-align: right;"><span><strong>EXPEDIENTE: [EXPEDIENTE_NUMERO]</strong></span></p><p>&nbsp;</p><p><span>[DIRECCION_NOMBRE]</span><br><span>[DOCUMENTO_CIUDAD], BAJA CALIFORNIA</span><br><span>PRESENTE.-</span></p><p>&nbsp;</p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Por medio del presente, con fundamento en el art&iacute;culo 8 Fracc. VII de la Ley de Atenci&oacute;n y protecci&oacute;n a la V&iacute;ctima u Ofendido del Delito para el Estado de Baja California, articulo 109 fracciones XVI, XVIII y XIX y art&iacute;culo 137 en sus Fracc. IV, V, VI, VII, VIII, IX y X del C&oacute;digo Nacional de Procedimientos Penales vigente en el Estado de Baja California, y como medida de protecci&oacute;n a la v&iacute;ctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la v&iacute;ctima de nombre [VICTIMA_NOMBRE] de [VICTIMA_EDAD], a efectos de que <strong>realicen rondines</strong> de vigilancia por 72 horas en el domicilio ubicado en[VICTIMA_DOMICILIO] de esta ciudad, con tel&eacute;fono de contacto el [VICTIMA_TELEFONO], con la finalidad de salvaguardar en todo momento su integridad f&iacute;sica, ya que presento denuncia por el delito de [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE]&nbsp; de [IMPUTADO_EDAD]. Sin m&aacute;s por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigaci&oacute;n correspondiente sobre las diligencias realizadas al respecto.</span></p><p>&nbsp;</p><p style="text-align: center;"><span>[DOCUMENTO_CIUDAD], BAJA CALIFORNIA, [DOCUMENTO_FECHA<br>[EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span><br><span>AGENTE DEL MINISTERIO P&Uacute;BLICO</span><br><span>ADSCRITO AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA</span></p>',
				'TEXTO' => 'Por medio del presente, con fundamento en el artículo 8 Fracc. VII de la Ley de Atención y protección a la Víctima u Ofendido del Delito para el Estado de Baja California, articulo 109 fracciones XVI, XVIII y XIX y artículo 137 en sus Fracc. IV, V, VI, VII, VIII, IX y X del Código Nacional de Procedimientos Penales vigente en el Estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la víctima de nombre [VICTIMA_NOMBRE] de [VICTIMA_EDAD], a efectos de que realicen rondines de vigilancia por 72 horas en el domicilio ubicado en[VICTIMA_DOMICILIO] de esta ciudad, con teléfono de contacto el [VICTIMA_TELEFONO], con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE] de [IMPUTADO_EDAD]. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1761,
				'CLASIFICACIONDOCTOMEXICALIID' => 1646,
				'PLANTILLAJUSTICIATIJUANAID' => 1761,
				'CLASIFICACIONDOCTOTIJUANAID' => 1646,
				'PLANTILLAJUSTICIAENSENADAID' => 1704,
				'CLASIFICACIONDOCTOENSENADAID' => 1626,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'ORDEN DE PROTECCION (REALICEN RONDINES MUJER)',
				'PLACEHOLDER' => '<p style="text-align: right;"><span><strong>EXPEDIENTE: [EXPEDIENTE_NUMERO]</strong></span></p><p>&nbsp;</p><p><span>[DIRECCION_NOMBRE]</span><br><span>[DOCUMENTO_CIUDAD], BAJA CALIFORNIA</span><br><span>PRESENTE.-</span></p><p>&nbsp;</p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Por medio del presente, con fundamento en los art&iacute;culos 21, 22, 23, 24, 25, 26 de la Ley de Acceso a las Mujeres a una Vida Libre de Violencia para el Estado de Baja California, art. 8 Fracc. VII&nbsp; de la Ley de Atenci&oacute;n y protecci&oacute;n a la V&iacute;ctima u Ofendido&nbsp; del Delito para el estado de Baja California,&nbsp; articulo 109 fracciones XVI, XVIII y XIX y art&iacute;culo 137&nbsp; en sus Fracc. IV, V, VI, VII, VIII, IX y X&nbsp; del C&oacute;digo Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protecci&oacute;n a la v&iacute;ctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la v&iacute;ctima de nombre [VICTIMA_NOMBRE] de [VICTIMA_EDAD], a efectos de que <strong>realicen rondines</strong> de vigilancia por 72 horas en el domicilio ubicado en[VICTIMA_DOMICILIO] de esta ciudad, con tel&eacute;fono de contacto el [VICTIMA_TELEFONO], con la finalidad de salvaguardar en todo momento su integridad f&iacute;sica, ya que presento denuncia por el delito de [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE]&nbsp; de [IMPUTADO_EDAD]. Sin m&aacute;s por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigaci&oacute;n correspondiente sobre las diligencias realizadas al respecto.</span></p><p>&nbsp;</p><p style="text-align: center;"><span>[DOCUMENTO_CIUDAD], BAJA CALIFORNIA, [DOCUMENTO_FECHA<br>[EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span><br><span>AGENTE DEL MINISTERIO P&Uacute;BLICO</span><br><span>ADSCRITO AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA</span></p>',
				'TEXTO' => 'Por medio del presente, con fundamento en los artículos 21, 22, 23, 24, 25, 26 de la Ley de Acceso a las Mujeres a una Vida Libre de Violencia para el Estado de Baja California, art. 8 Fracc. VII de la Ley de Atención y protección a la Víctima u Ofendido del Delito para el estado de Baja California, articulo 109 fracciones XVI, XVIII y XIX y artículo 137 en sus Fracc. IV, V, VI, VII, VIII, IX y X del Código Nacional de Procedimientos Penales vigente en el estado de Baja California, y como medida de protección a la víctima, se solicita su apoyo para designar personal a su digno cargo para efectos de prestar auxilio inmediato a la víctima de nombre [VICTIMA_NOMBRE] de [VICTIMA_EDAD], a efectos de que realicen rondines de vigilancia por 72 horas en el domicilio ubicado en[VICTIMA_DOMICILIO] de esta ciudad, con teléfono de contacto el [VICTIMA_TELEFONO], con la finalidad de salvaguardar en todo momento su integridad física, ya que presento denuncia por el delito de [RELACION_DELITO] al imputado de nombre [IMPUTADO_NOMBRE] de [IMPUTADO_EDAD]. Sin más por el momento se agradecen las atenciones brindadas a la presente, solicitando sea informado a la Unidad de Investigación correspondiente sobre las diligencias realizadas al respecto.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1621,
				'CLASIFICACIONDOCTOMEXICALIID' => 1539,
				'PLANTILLAJUSTICIATIJUANAID' => 1621,
				'CLASIFICACIONDOCTOTIJUANAID' => 1539,
				'PLANTILLAJUSTICIAENSENADAID' => 1621,
				'CLASIFICACIONDOCTOENSENADAID' => 1539,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'SOLICITUD DE PERITAJE (CERTIFICADO DE HOSPITAL)',
				'PLACEHOLDER' => '<p style="text-align: center;"><span><strong>SOLICITUD DE PERITAJE</strong></span></p><p style="text-align: center;">&nbsp;</p><p style="text-align: right;"><span>No. de Caso: <strong>[EXPEDIENTE_NUMERO]</strong></span></p><p><span><strong>C. DIRECTOR DE SERVICIOS PERICIALES<br></strong><strong>Presente.-</strong></span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Por este conducto, solicito se sirva designar los peritos que se requieran, a fin de que dictamine(n) o informe(n), seg&uacute;n sea el caso, respecto de la(s) siguiente(s) solicitud(es) pericial(es): <strong>1 CERTIFICADO DE INTEGRIDAD F&Iacute;SICA EN HOSPITAL </strong>que deber&aacute; practicarse a: [VICTIMA_NOMBRE] de [VICTIMA_EDAD] a&ntilde;os de edad, sexo: [VICTIMA_SEXO], estatura aproximada: _________ metros, tez:_____, color de ojos: _______, cabello: _____, cejas:__________, se&ntilde;as particulares: ________, quien en fecha: [HECHO_FECHA], hora aproximada: [HECHO_HORA] en: [HECHO_LUGAR] fue lesionado/herido:____________ (tipo de hecho, tr&aacute;nsito, atropellamiento, herido por arma de fuego, herido por arma blanca), motivo por el que se le traslad&oacute; por parte de: ________ al hospital _______________ con domicilio en la ciudad de___________, Baja California, en donde se encuentra internado en el&nbsp; &aacute;rea de _____________( ejemplo: &aacute;rea de urgencias, primer piso, segundo piso, numero de cama ), por tanto, con el objeto de esclarecer los hechos correspondientes a la carpeta de investigaci&oacute;n Numero [EXPEDIENTE_NUMERO], se solicita que el perito asignado se traslade a las instalaciones de tal hospital debiendo determinar el tipo de lesiones que presenta la persona internada, as&iacute; como su descripci&oacute;n y clasificaci&oacute;n m&eacute;dico legal</span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;En el caso de ni&ntilde;os, ni&ntilde;as o adolescentes, solicitar: <strong>S&Iacute;NDROME DE NI&Ntilde;O MALTRATADO</strong>.</span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Lo anterior con fundamento en los art&iacute;culos 127, fracciones III y IX, 131 del c&oacute;digo Nacional de Procedimientos Penales vigente en el Estado; 272, 368 y dem&aacute;s aplicables del c&oacute;digo Penal para el estado de baja California, as&iacute; como relativos a la Ley Org&aacute;nica de la Fiscal&iacute;a del estado y su Reglamento.</span></p><p>&nbsp;</p><p style="text-align: center;"><span>[DOCUMENTO_CIUDAD], BAJA CALIFORNIA</span><br><span>[DOCUMENTO_FECHA]</span><br><span>LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span><br><span>AGENTE DEL MINISTERIO PUBLICO CON ADSCRIPCI&Oacute;N</span><br><span>AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA</span></p>',
				'TEXTO' => 'Por este conducto, solicito se sirva designar los peritos que se requieran, a fin de que dictamine(n) o informe(n), según sea el caso, respecto de la(s) siguiente(s) solicitud(es) pericial(es): 1 CERTIFICADO DE INTEGRIDAD FÍSICA EN HOSPITAL que deberá practicarse a: [VICTIMA_NOMBRE] de [VICTIMA_EDAD] años de edad, sexo: [VICTIMA_SEXO], estatura aproximada: _________ metros, tez:_____, color de ojos: _______, cabello: _____, cejas:__________, señas particulares: ________, quien en fecha: [HECHO_FECHA], hora aproximada: [HECHO_HORA] en: [HECHO_LUGAR] fue lesionado/herido:____________ (tipo de hecho, tránsito, atropellamiento, herido por arma de fuego, herido por arma blanca), motivo por el que se le trasladó por parte de: ________ al hospital _______________ con domicilio en la ciudad de___________, Baja California, en donde se encuentra internado en el área de _____________( ejemplo: área de urgencias, primer piso, segundo piso, numero de cama ), por tanto, con el objeto de esclarecer los hechos correspondientes a la carpeta de investigación Numero [EXPEDIENTE_NUMERO], se solicita que el perito asignado se traslade a las instalaciones de tal hospital debiendo determinar el tipo de lesiones que presenta la persona internada, así como su descripción y clasificación médico legal En el caso de niños, niñas o adolescentes, solicitar: SÍNDROME DE NIÑO MALTRATADO. Lo anterior con fundamento en los artículos 127, fracciones III y IX, 131 del código Nacional de Procedimientos Penales vigente en el Estado; 272, 368 y demás aplicables del código Penal para el estado de baja California, así como relativos a la Ley Orgánica de la Fiscalía del estado y su Reglamento.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1583,
				'CLASIFICACIONDOCTOMEXICALIID' => 1478,
				'PLANTILLAJUSTICIATIJUANAID' => 1583,
				'CLASIFICACIONDOCTOTIJUANAID' => 1478,
				'PLANTILLAJUSTICIAENSENADAID' => 1583,
				'CLASIFICACIONDOCTOENSENADAID' => 1478,
				'AREAPERICIALMEXICALIID' => 9,
				'INTERVENCIONMEXICALIID' => 98,
				'AREAPERICIALTIJUANAID' => 9,
				'INTERVENCIONTIJUANAID' => 98,
				'AREAPERICIALENSENADAID' => 9,
				'INTERVENCIONENSENADAID' => 98,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'SOLICITUD DE PERITAJE (CERTIFICADO DE INTEGRIDAD FÍSICA)',
				'PLACEHOLDER' => '<p style="text-align: center;"><span><strong>SOLICITUD DE PERITAJE</strong></span></p><p style="text-align: center;">&nbsp;</p><p style="text-align: right;"><span>No. de Caso:<strong> [EXPEDIENTE_NUMERO]</strong></span></p><p><span><strong>C. DIRECTOR DE SERVICIOS PERICIALES<br></strong><strong>Presente.-</strong></span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Por este conducto, solicito se sirva designar los peritos que se requieran, a fin de que dictamine(n) o informe(n), seg&uacute;n sea el caso, respecto de la(s) siguiente(s) solicitud(es) pericial(es):</span></p><p style="text-align: justify;"><span>1 <strong>CERTIFICADOS DE INTEGRIDAD F&Iacute;SICA</strong>, que deber&aacute; practicarse a quien indica llamarse [VICTIMA_NOMBRE], de [VICTIMA_EDAD] a&ntilde;os de edad, con n&uacute;mero telef&oacute;nico [VICTIMA_TELEFONO], correo electr&oacute;nico [VICTIMA_CORREO], con la finalidad de determinar si presenta lesiones y en caso afirmativo se describa a detalle cada una de ellas as&iacute; como la clasificaci&oacute;n m&eacute;dica que corresponda.&nbsp;</span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Asimismo, en el caso de ni&ntilde;as, ni&ntilde;os o adolescentes especificar se presente el s&iacute;ndrome de Ni&ntilde;o Maltratado.</span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Lo anterior con el objeto de esclarecer los hechos correspondientes a la Carpeta de Investigaci&oacute;n n&uacute;mero <strong>[EXPEDIENTE_NUMERO].</strong></span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Lo anterior, con fundamento en los art&iacute;culos 127, fracciones III y IX, 131 del C&oacute;digo Nacional de Procedimientos Penales vigente en el Estado; 272, 368 y dem&aacute;s aplicables del C&oacute;digo Penal para el Estado de Baja California, as&iacute; como dem&aacute;s relativos a la Ley Org&aacute;nica de la Fiscal&iacute;a General del Estado y su Reglamento.</span></p><p>&nbsp;</p><p style="text-align: center;"><span>[DOCUMENTO_CIUDAD], BAJA CALIFORNIA</span><br><span>[DOCUMENTO_FECHA]</span><br><span>LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span><br><span>AGENTE DEL MINISTERIO PUBLICO CON ADSCRIPCI&Oacute;N</span><br><span>AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA &nbsp;</span></p>',
				'TEXTO' => 'Por este conducto, solicito se sirva designar los peritos que se requieran, a fin de que dictamine(n) o informe(n), según sea el caso, respecto de la(s) siguiente(s) solicitud(es) pericial(es): 1 CERTIFICADOS DE INTEGRIDAD FÍSICA, que deberá practicarse a quien indica llamarse [VICTIMA_NOMBRE], de [VICTIMA_EDAD] años de edad, con número telefónico [VICTIMA_TELEFONO], correo electrónico [VICTIMA_CORREO], con la finalidad de determinar si presenta lesiones y en caso afirmativo se describa a detalle cada una de ellas así como la clasificación médica que corresponda. Asimismo, en el caso de niñas, niños o adolescentes especificar se presente el síndrome de Niño Maltratado. Lo anterior con el objeto de esclarecer los hechos correspondientes a la Carpeta de Investigación número [EXPEDIENTE_NUMERO]. Lo anterior, con fundamento en los artículos 127, fracciones III y IX, 131 del Código Nacional de Procedimientos Penales vigente en el Estado; 272, 368 y demás aplicables del Código Penal para el Estado de Baja California, así como demás relativos a la Ley Orgánica de la Fiscalía General del Estado y su Reglamento.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1583,
				'CLASIFICACIONDOCTOMEXICALIID' => 1478,
				'PLANTILLAJUSTICIATIJUANAID' => 1583,
				'CLASIFICACIONDOCTOTIJUANAID' => 1478,
				'PLANTILLAJUSTICIAENSENADAID' => 1583,
				'CLASIFICACIONDOCTOENSENADAID' => 1478,
				'AREAPERICIALMEXICALIID' => 9,
				'INTERVENCIONMEXICALIID' => 99,
				'AREAPERICIALTIJUANAID' => 9,
				'INTERVENCIONTIJUANAID' => 99,
				'AREAPERICIALENSENADAID' => 9,
				'INTERVENCIONENSENADAID' => 99,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'SOLICITUD DE PERITAJE (CERTIFICADO GINECOLOGICO)',
				'PLACEHOLDER' => '<p style="text-align: center;"><span><strong>SOLICITUD DE PERITAJE</strong></span></p><p>&nbsp;</p><p style="text-align: right;"><span>No. de Caso: <strong>[EXPEDIENTE_NUMERO]</strong></span></p><p><span><strong>C. DIRECTOR DE SERVICIOS PERICIALES<br></strong><strong>Presente.-</strong></span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Por este conducto, solicito se sirva designar los peritos que se requieran, a fin de que dictamine o informe, seg&uacute;n sea el caso, respecto de la siguiente solicitud pericial:</span></p><p style="text-align: justify;"><span><strong>1</strong> <strong>CERTIFICADO M&Eacute;DICO PARA LA INVESTIGACI&Oacute;N DE DELITOS SEXUALES </strong>que deber&aacute; practicase a quien indica llamarse [VICTIMA_NOMBRE], de [VICTIMA_EDAD] a&ntilde;os de edad, con n&uacute;mero telef&oacute;nico [VICTIMA_TELEFONO], correo electr&oacute;nico [VICTIMA_CORREO], quien es acompa&ntilde;ada por:_________</span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Lo anterior con el objeto de esclarecer los hechos correspondientes a la Carpeta de Investigaci&oacute;n n&uacute;mero [EXPEDIENTE_NUMERO], iniciada por el delito de [DELITO_NOMBRE], por tanto es necesario se determine lo siguiente: <strong>I.-</strong>Tipo de Himen, <strong>II.- </strong>Si el Himen se encuentra integro o desgarrado, <strong>III.- </strong>De encontrarse desgarre en el himen, si &eacute;ste o &eacute;stos son o no recientes. <strong>IV.-</strong>Si presenta lesiones describir las zonas y tiempos que tardan en sanar, <strong>V.- </strong>Si est&aacute; o no embarazada cl&iacute;nicamente. <strong>VI.- </strong>Fecha de ultima menstruaci&oacute;n, <strong>VII</strong>.- Si presenta signos de contagio ven&eacute;reo. <strong>VIII</strong> Si presenta lesi&oacute;n anal, <strong>IX.- </strong>De encontrarse lesi&oacute;n anal, si esta es o no reciente. <strong>X.- </strong>De requerirse se practique el muestreo necesario, y en su momento emita el dictamen m&eacute;dico correspondiente a la <em>Unidad de Investigaci&oacute;n de Delitos Sexuales</em>. Determinando si es V&iacute;ctima de Violaci&oacute;n o Abuso Sexual. &nbsp;</span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Lo anterior con fundamento en los art&iacute;culos 127, fracciones III y IX del art&iacute;culo 131, 272, 368 y dem&aacute;s aplicables del C&oacute;digo Nacional de Procedimientos Penales vigente en el Estado, as&iacute; como dem&aacute;s relativos a la Ley Org&aacute;nica de la Procuradur&iacute;a General de Justicia del Estado y su Reglamento.</span></p><p>&nbsp;</p><p style="text-align: center;"><span>[DOCUMENTO_CIUDAD], BAJA CALIFORNIA</span><br><span>[DOCUMENTO_FECHA]</span><br><span>LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span><br><span>AGENTE DEL MINISTERIO PUBLICO CON ADSCRIPCI&Oacute;N</span><br><span>AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA &nbsp;</span></p><p>&nbsp;</p>',
				'TEXTO' => 'Por este conducto, solicito se sirva designar los peritos que se requieran, a fin de que dictamine o informe, según sea el caso, respecto de la siguiente solicitud pericial: 1 CERTIFICADO MÉDICO PARA LA INVESTIGACIÓN DE DELITOS SEXUALES que deberá practicase a quien indica llamarse [VICTIMA_NOMBRE], de [VICTIMA_EDAD] años de edad, con número telefónico [VICTIMA_TELEFONO], correo electrónico [VICTIMA_CORREO], quien es acompañada por:_________ Lo anterior con el objeto de esclarecer los hechos correspondientes a la Carpeta de Investigación número [EXPEDIENTE_NUMERO], iniciada por el delito de [DELITO_NOMBRE], por tanto es necesario se determine lo siguiente: I.-Tipo de Himen, II.- Si el Himen se encuentra integro o desgarrado, III.- De encontrarse desgarre en el himen, si éste o éstos son o no recientes. IV.-Si presenta lesiones describir las zonas y tiempos que tardan en sanar, V.- Si está o no embarazada clínicamente. VI.- Fecha de ultima menstruación, VII.- Si presenta signos de contagio venéreo. VIII Si presenta lesión anal, IX.- De encontrarse lesión anal, si esta es o no reciente. X.- De requerirse se practique el muestreo necesario, y en su momento emita el dictamen médico correspondiente a la Unidad de Investigación de Delitos Sexuales. Determinando si es Víctima de Violación o Abuso Sexual. Lo anterior con fundamento en los artículos 127, fracciones III y IX del artículo 131, 272, 368 y demás aplicables del Código Nacional de Procedimientos Penales vigente en el Estado, así como demás relativos a la Ley Orgánica de la Procuraduría General de Justicia del Estado y su Reglamento.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1583,
				'CLASIFICACIONDOCTOMEXICALIID' => 1478,
				'PLANTILLAJUSTICIATIJUANAID' => 1583,
				'CLASIFICACIONDOCTOTIJUANAID' => 1478,
				'PLANTILLAJUSTICIAENSENADAID' => 1583,
				'CLASIFICACIONDOCTOENSENADAID' => 1478,
				'AREAPERICIALMEXICALIID' => 9,
				'INTERVENCIONMEXICALIID' => 100,
				'AREAPERICIALTIJUANAID' => 9,
				'INTERVENCIONTIJUANAID' => 100,
				'AREAPERICIALENSENADAID' => 9,
				'INTERVENCIONENSENADAID' => 100,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'SOLICITUD DE PERITAJE (CERTIFICADO PROCTOLOGICO)',
				'PLACEHOLDER' => '<p style="text-align: center;"><span><strong>SOLICITUD DE PERITAJE</strong></span></p><p style="text-align: center;">&nbsp;</p><p style="text-align: right;"><span>No. de Caso: <strong>[EXPEDIENTE_NUMERO]</strong></span></p><p><span><strong>C. DIRECTOR DE&nbsp;SERVICIOS PERICIALES<br></strong><strong>Presente.-</strong></span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Por este conducto, solicito se sirva designar los peritos que se requieran, a fin de que dictamine(n) o informe(n), seg&uacute;n sea el caso, respecto de la(s) siguiente(s) solicitud(es) pericial(es):</span></p><p style="text-align: justify;"><span><strong>1 CERTIFICADOS M&Eacute;DICO PARA LA INVESTIGACI&Oacute;N DE DELITOS SEXUALES</strong>, que deber&aacute; practicarse a quien indica llamarse [VICTIMA_NOMBRE], de [VICTIMA_EDAD] a&ntilde;os de edad, con n&uacute;mero telef&oacute;nico [VICTIMA_TELEFONO], correo electr&oacute;nico [VICTIMA_CORREO], quien&nbsp; comparece en compa&ntilde;&iacute;a de: __________________.</span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Tal petici&oacute;n es con el objeto de esclarecer los hechos correspondientes a la Carpeta de Investigaci&oacute;n n&uacute;mero [EXPEDIENTE_NUMERO], debiendo determinar lo siguiente:</span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Si presenta lesi&oacute;n anal, en caso afirmativo se&ntilde;alar si la misma es reciente o no; si presenta lesiones describir las zonas y tiempo en sanar; si presenta signos de contagio ven&eacute;reo; en caso de ser necesario se proceda a recabar muestras biol&oacute;gicas para su posterior an&aacute;lisis y elaboraci&oacute;n de los dict&aacute;menes correspondientes.</span></p><p style="text-align: justify;"><span>&nbsp; &nbsp; &nbsp;Lo anterior con fundamento en los art&iacute;culos 127, fracciones III y IX del art&iacute;culo 131, 272, 368 y dem&aacute;s aplicables del C&oacute;digo Nacional de Procedimientos Penales vigente en el Estado, as&iacute; como dem&aacute;s relativos a la Ley Org&aacute;nica de la Procuradur&iacute;a General de Justicia del Estado y su Reglamento.</span></p><p style="text-align: justify;">&nbsp;</p><p style="text-align: center;"><span>[DOCUMENTO_CIUDAD], BAJA CALIFORNIA</span><br><span>[DOCUMENTO_FECHA]</span><br><span>LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]</span><br><span>AGENTE DEL MINISTERIO PUBLICO CON ADSCRIPCI&Oacute;N</span><br><span>AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA</span></p><p>&nbsp;</p>',
				'TEXTO' => 'Por este conducto, solicito se sirva designar los peritos que se requieran, a fin de que dictamine(n) o informe(n), según sea el caso, respecto de la(s) siguiente(s) solicitud(es) pericial(es): 1 CERTIFICADOS MÉDICO PARA LA INVESTIGACIÓN DE DELITOS SEXUALES, que deberá practicarse a quien indica llamarse [VICTIMA_NOMBRE], de [VICTIMA_EDAD] años de edad, con número telefónico [VICTIMA_TELEFONO], correo electrónico [VICTIMA_CORREO], quien comparece en compañía de: __________________. Tal petición es con el objeto de esclarecer los hechos correspondientes a la Carpeta de Investigación número [EXPEDIENTE_NUMERO], debiendo determinar lo siguiente: Si presenta lesión anal, en caso afirmativo señalar si la misma es reciente o no; si presenta lesiones describir las zonas y tiempo en sanar; si presenta signos de contagio venéreo; en caso de ser necesario se proceda a recabar muestras biológicas para su posterior análisis y elaboración de los dictámenes correspondientes. Lo anterior con fundamento en los artículos 127, fracciones III y IX del artículo 131, 272, 368 y demás aplicables del Código Nacional de Procedimientos Penales vigente en el Estado, así como demás relativos a la Ley Orgánica de la Procuraduría General de Justicia del Estado y su Reglamento.',
				'PLANTILLAJUSTICIAMEXICALIID' => 1583,
				'CLASIFICACIONDOCTOMEXICALIID' => 1478,
				'PLANTILLAJUSTICIATIJUANAID' => 1583,
				'CLASIFICACIONDOCTOTIJUANAID' => 1478,
				'PLANTILLAJUSTICIAENSENADAID' => 1583,
				'CLASIFICACIONDOCTOENSENADAID' => 1478,
				'AREAPERICIALMEXICALIID' => 9,
				'INTERVENCIONMEXICALIID' => 101,
				'AREAPERICIALTIJUANAID' => 9,
				'INTERVENCIONTIJUANAID' => 101,
				'AREAPERICIALENSENADAID' => 9,
				'INTERVENCIONENSENADAID' => 101,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'CARTA DE DERIVACION',
				'PLACEHOLDER' => '<p class="p1" style="text-align: center;"><strong>CARTA DERIVACI&Oacute;N</strong></p><p class="p1" style="text-align: center;">&nbsp;</p><p class="p2" style="text-align: right;">Fecha de atenci&oacute;n: [DOCUMENTO_FECHA]<br>Hora: [HORA]:[MINUTOS]</p><p class="p3">&nbsp;</p><p class="p4" style="text-align: justify;"><strong>Registro de atenci&oacute;n ciudadana:</strong> [FOLIO_ATENCION]</p><p class="p4" style="text-align: justify;"><strong>Nombre del denunciante:</strong> [DENUNCIANTE_NOMBRE]</p><p class="p4" style="text-align: justify;"><strong>Narraci&oacute;n breve:</strong> [HECHO]</p><p class="p4" style="text-align: justify;"><strong>Se sugiere acudir a:</strong> [OFICINA_NOMBRE]</p><p class="p4" style="text-align: justify;"><strong>Domicilio:</strong> [OFICINA_DOMICILIO]</p><p class="p3">&nbsp;</p><p class="p1" style="text-align: center;">LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]<br>AGENTE DEL MINISTERIO PUBLICO CON ADSCRIPCI&Oacute;N<br>AL CENTRO DE DENUNCIA TECNOL&Oacute;GICA</p>',
				'TEXTO' => 'Registro de atención ciudadana: [FOLIO_ATENCION] | Nombre del denunciante: [DENUNCIANTE_NOMBRE] | Narración breve: [HECHO] | Se sugiere acudir a: [OFICINA_NOMBRE] | Domicilio: [OFICINA_DOMICILIO]',
				'PLANTILLAJUSTICIAMEXICALIID' => NULL,
				'CLASIFICACIONDOCTOMEXICALIID' => NULL,
				'PLANTILLAJUSTICIATIJUANAID' => NULL,
				'CLASIFICACIONDOCTOTIJUANAID' => NULL,
				'PLANTILLAJUSTICIAENSENADAID' => NULL,
				'CLASIFICACIONDOCTOENSENADAID' => NULL,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'CITATORIO',
				'PLACEHOLDER' => '<p style="text-align: center;"><strong>CITATORIO</strong></p><p>&nbsp;</p><p style="text-align: right;"><strong>EXPEDIENTE: [EXPEDIENTE_NUMERO]<br></strong><strong>TIPO DE NOTIFICACI&Oacute;N: (PERSONAL / NOTIFICADOR)<br></strong>[DOCUMENTO_MUNICIPIO], Baja California a [DIA] de [MES] de [ANO]</p><p>&nbsp;</p><p>[IMPUTADO_NOMBRE]<br>[IMPUTADO_DOMICILIO_COMPLETO]<br>Presente.-</p><p>&nbsp;</p><p style="text-align: justify;">&nbsp; &nbsp; &nbsp;Por este conducto, y en atenci&oacute;n a la solicitud planteada por [VICTIMAS_NOMBRE], me permito citarle en la UNIDAD DE MECANISMOS ALTERNATIVOS (UMA), a fin de tratar un asunto de car&aacute;cter penal a trav&eacute;s de la [TIPO_PROCESO].</p><p style="text-align: justify;">&nbsp; &nbsp; &nbsp;En el proceso de [TIPO_PROCESO] podr&aacute; encontrar una alternativa de soluci&oacute;n r&aacute;pida que le permitir&aacute; manifestar sus necesidades e intereses respecto del asunto que hoy se plantea. Se le informa que ser&aacute; atendido por el (la) Facilitador (a) [NOMBRE_FACILITADOR], el d&iacute;a [DIA] de [MES] de [ANO], a las [HORA]:[MINUTOS] horas,en las instalaciones ubicadas en <strong>[DOMICILIO_INSTALACION]</strong></p><p style="text-align: justify;">&nbsp; &nbsp; &nbsp;Todos nuestros servicios son gratuitos, por lo que ning&uacute;n servidor p&uacute;blico podr&aacute; cobrarle remuneraci&oacute;n alguna.</p><p style="text-decoration: underline; text-align: justify;">En caso de ser positivo o presentar alg&uacute;n s&iacute;ntoma relacionado con Covid-19 en la fecha de su cita, favor de informarlo, para efecto de agendar nueva cita en caso de ser procedente, lo anterior con el fin de acatar las medidas de prevenci&oacute;n establecidas ante esta contingencia sanitaria.</p><p style="text-align: justify;">&nbsp; &nbsp; &nbsp;Lo anterior con fundamento en los art&iacute;culos 90 y 91 del C&oacute;digo Nacional de Procedimientos Penales, el diverso 22 fracci&oacute;n XVIII de la Ley Org&aacute;nica de la Fiscal&iacute;a General del Estado y los art&iacute;culos 14, 15 y 16 de la Ley Nacional de Mecanismos Alternativos de Soluci&oacute;n de Controversias en Materia Penal y dem&aacute;s relativos.</p><p>&nbsp;</p><p style="text-align: center;"><strong>A t e n t a m e n t e</strong></p><p style="text-align: center;"><strong>LIC. [EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]<br></strong>AGENTE DEL MINISTERIO PUBLICO CON ADSCRIPCI&Oacute;N &nbsp;<br>AL CENTRO DE DENUNCIA TECN&Oacute;LOGICA &nbsp;</p><p style="text-align: center;">&nbsp;</p><p>Tel&eacute;fonos: <strong>[TELEFONO_UMA]</strong></p>',
				'TEXTO' => 'Por este conducto, y en atención a la solicitud planteada por [VICTIMAS_NOMBRE], me permito citarle en la UNIDAD DE MECANISMOS ALTERNATIVOS (UMA), a fin de tratar un asunto de carácter penal a través de la [TIPO_PROCESO].En el proceso de mediación [TIPO_PROCESO] podrá encontrar una alternativa de solución rápida que le permitirá manifestar sus necesidades e intereses respecto del asunto que hoy se plantea. Se le informa que será atendido por el (la) Facilitador (a) [NOMBRE_FACILITADOR], el día [DIA] de [MES] de [ANO], a las [HORA]:[MINUTOS] horas,en las instalaciones ubicadas en [DOMICILIO_INSTALACION] Todos nuestros servicios son gratuitos, por lo que ningún servidor público podrá cobrarle remuneración alguna. En caso de ser positivo o presentar algún síntoma relacionado con Covid-19 en la fechade su cita, favor de informarlo, para efecto de agendar nueva cita en caso de ser procedente, lo anterior con el fin de acatar las medidas de prevención establecidas ante esta contingencia sanitaria. Lo anterior con fundamento en los artículos 90 y 91 del Código Nacional de Procedimientos Penales, el diverso 22 fracción XVIII de la Ley Orgánica de la Fiscalía General del Estado y los artículos 14, 15 y 16 de la Ley Nacional de Mecanismos Alternativos de Solución de Controversias en Materia Penal y demás relativos.',
				'PLANTILLAJUSTICIAMEXICALIID' => NULL,
				'CLASIFICACIONDOCTOMEXICALIID' => NULL,
				'PLANTILLAJUSTICIATIJUANAID' => NULL,
				'CLASIFICACIONDOCTOTIJUANAID' => NULL,
				'PLANTILLAJUSTICIAENSENADAID' => NULL,
				'CLASIFICACIONDOCTOENSENADAID' => NULL,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
			array(
				'DESCRIPCION' => '', 'TITULO' => 'DENUNCIA ANONIMA',
				'PLACEHOLDER' => '
				<p style="text-align: right;">&nbsp;</p>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-style: solid; border-top-width: 2px; border-right-width: 2px; border-bottom-width: 2px; border-left-width: 2px">
					<tbody>
						<tr>
						 <td>
							<p>
								<span style="color: rgb(0, 0, 0);">Folio: </span>
								<span style="color: rgb(0, 0, 0);text-decoration: underline;">[FOLIO] </span>
							</p>
						</td>
						<td>
							<p>
								<span style="color: rgb(0, 0, 0);">Fecha: </span>
								<span style="color: rgb(0, 0, 0);text-decoration: underline;">[DIA] / [MES] / [ANO] </span>
				
							</p>
						</td>
						<td>
							<p>
								<span style="color: rgb(0, 0, 0);"> Hora: </span>
								<span style="color: rgb(0, 0, 0);text-decoration: underline;">[HORA] : [MINUTOS]</span>
				
							</p>
						</td>
						<td>
							<p>
								<span style="color: rgb(0, 0, 0);"> Usuario:</span>
								<span style="color: rgb(0, 0, 0);text-decoration: underline;">[USUARIO_ID]</span>
				
				
							</p>
						</td>
				
					</tr>
				</tbody>
				</table>
				<br>
				<p style="text-align: center;"><strong>Datos del Hecho</strong></p>
				<hr></hr>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tbody>
						<tr>
				
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);">Fecha Delito: </span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[DIA] / [MES] / [ANO] </span>
				
								</p>
							</td>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);"> Hora Delito: </span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[HORA] : [MINUTOS]</span>
				
								</p>
							</td>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);"> Municipio:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[MUNICIPIO_DELITO]</span>        
				
				
				
								</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);"> Delegación:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[LOCALIDAD_DELITO]</span>
								</p>
							</td>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);"> Colonia:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[COLONIA_DELITO]</span>
								</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);"> Dirección:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[DIRECCION]</span>
								</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);"> No. Ext:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[EXTERIOR]</span>
								</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);">Calles:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[CALLE]</span>
								</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);">Lugar:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[LUGAR_HECHO]</span>
								</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);">Referencias:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[REFERENCIAS]</span>
								</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);">Armas:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[ARMAS]</span>
								</p>
							</td>
						</tr>
					</tbody>
				</table>
				<hr></hr>
				<br>
				<p style="text-align: center;"><strong>Delitos</strong></p>
				[TABLA_DELITOS]
				<br>
				<p style="text-align: left; padding-left: 10%;"><strong>Denunciados</strong></p>
				[TABLA_IMPUTADOS]
				
				<br>
				<p style="text-align: left; padding-left: 10%;"><strong>Vehículos sospechosos</strong></p>
				[TABLA_VEHICULOS]
				
				<br>
				<p style="text-align: right;">&nbsp;</p>
				<table width="100%" border="0" cellspacing="0" cellpadding="3"  style="border-style: solid; border-top-width: 2px; border-right-width: 2px; border-bottom-width: 2px; border-left-width: 2px">    
					<tbody>
						<tr style="text-align: center; font-weight: bold;">
						 <td colspan="5">
							<p>
								<span style="color: rgb(0, 0, 0);">Notas </span>
				
							</p>
						</td>
						<td colspan="5">
							<p>
								<span style="color: rgb(0, 0, 0);">Hora </span>
							</p>
						</td>
					   <tr style="text-align: center;">
						 <td colspan="5">
							<p>
								<span style="color: rgb(0, 0, 0);">[NOTAS] </span>
				
							</p>
						</td>
						<td colspan="5">
							<p>
								<span style="color: rgb(0, 0, 0);">[HORA_NOTAS]</span>
							</p>
						</td>
					   </tr>
				
					</tr>
				</tbody>
				</table>
				<br>
				',
				'TEXTO' => NULL,
				'PLANTILLAJUSTICIAMEXICALIID' => NULL,
				'CLASIFICACIONDOCTOMEXICALIID' => NULL,
				'PLANTILLAJUSTICIATIJUANAID' => NULL,
				'CLASIFICACIONDOCTOTIJUANAID' => NULL,
				'PLANTILLAJUSTICIAENSENADAID' => NULL,
				'CLASIFICACIONDOCTOENSENADAID' => NULL,
				'AREAPERICIALMEXICALIID' => NULL,
				'INTERVENCIONMEXICALIID' => NULL,
				'AREAPERICIALTIJUANAID' => NULL,
				'INTERVENCIONTIJUANAID' => NULL,
				'AREAPERICIALENSENADAID' => NULL,
				'INTERVENCIONENSENADAID' => NULL,
			),
		];

		$this->db->table('PLANTILLAS')->insertBatch($data);
	}
}
