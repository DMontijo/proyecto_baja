<?php

header('Content-Type: text/html; charset=UTF-8');
header("Content-Type: application/xml");
date_default_timezone_set('America/Tijuana');

use setasign\Fpdi\Fpdi;

require("lib/pclzip.lib.php");
include("qrlib/qrlib.php");
include("fpdf/fpdf.php");
require_once('FPDI/src/autoload.php');

$pdf_dir        = $_FILES['ArchFIELpdf']["tmp_name"];
$key            = $_FILES['ArchFIELkey']["tmp_name"];
$cer            = $_FILES['ArchFIELcer']["tmp_name"];
$FIEL_password  = $_POST["ClaveFIEL"];


$FIEL_file_key = $key . ".key";  // Nombre del archivo .key de la FIEL (Clave privada).
$FIEL_file_cer = $cer . ".cer";  // Nombre del archivo .cer de la FIEL (Clave pública).
$PDF_file = $pdf_dir . ".pdf";

rename($key, $FIEL_file_key);
chmod($FIEL_file_key, 0777);

rename($cer, $FIEL_file_cer);
chmod($FIEL_file_cer, 0777);

rename($pdf_dir, $PDF_file);
chmod($PDF_file, 0777);

$file_key_pem = $key . ".key.pem";  // Nombre del archivo .key.pem
$file_cer_pem = $cer . ".cer.pem";  // Nombre del archivo .cer.pem 

$FolioDoc = uniqid(); // Se crea un número aleatorio como número de documento. El programador puede asignar el número de folio se asigne por sistema.

$NomArch_DatosFIEL  = "DatosFiel_" . $FolioDoc . ".txt";

$Nombre = "";
$RFC    = "";

$Valid_ApertArchsFIEL;

# OBTENIENDO ARCHIVOS .PEM #############################################################################################################################################

//==========================================================================
# Obtener el archivo .key.pem del archivo .key (Llave privada).

$Comando_key_pem = "pkcs8 -inform DER -in " . $FIEL_file_key . " -passin pass:$FIEL_password -out " . $file_key_pem;

exec('openssl ' . $Comando_key_pem, $arr, $status);

if ($status === 0) {

	# Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
	chmod($file_key_pem, 0777);

	// Archivo correctamente procesado.
	$Valid_ApertArchsFIEL = 0;
} else {
	// Error;
	$Valid_ApertArchsFIEL = 1;
}

//==========================================================================
# Obtener el archivo .cer.pem del archivo .cer

$Comando_cer_pem = "x509 -inform DER -outform PEM -in " . $FIEL_file_cer . " -passin pass:$FIEL_password -out " . $file_cer_pem;

exec('openssl ' . $Comando_cer_pem, $arr, $status);

if ($status === 0) {

	# Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
	chmod($file_cer_pem, 0777);

	// Archivo correctamente procesado.
	$Valid_ApertArchsFIEL = 0;
} else {
	// Error.
	$Valid_ApertArchsFIEL = 1;
}



# VERIFICAR SI LOS ARCHIVOS CORRESPONEDEN A UNA FIEL ###################################################################################################################

//===============================================================
# Obtener datos del archivo .cer.pem y guardarlos en un archivo .txt

$ComandoOpenSSL = "x509 -in " . $file_cer_pem . " > " . $NomArch_DatosFIEL . " -text";

exec('openssl ' . $ComandoOpenSSL, $arr, $status);

if ($status == 0) {

	chmod($NomArch_DatosFIEL, 0777);

	$sslcert = file_get_contents($NomArch_DatosFIEL);
	$sslcert = array(openssl_x509_parse($sslcert, TRUE));

	// var_dump($sslcert);

	foreach ($sslcert as $name => $arrays) {

		foreach ($arrays as $title => $value) {

			if (is_array($value)) {

				foreach ($value as $subtitle => $subvalue) {

					if ($subtitle == "keyUsage") {

						$ArrayUsos = explode(",", $subvalue);
					}
				}
			}
		}
	}

	$ResBus1 = false;
	$ResBus2 = false;
	$ResBus3 = false;

	for ($i = 0; $i < count($ArrayUsos); $i++) {

		if (trim($ArrayUsos[$i]) == "Digital Signature") {
			$ResBus1 = true;
		}
		if (trim($ArrayUsos[$i]) == "Data Encipherment") {
			$ResBus2 = true;
		}
		if (trim($ArrayUsos[$i]) == "Key Agreement") {
			$ResBus3 = true;
		}
	}

	// print_r($ArrayUsos);
	// exit;

	if ($ResBus1 && $ResBus2 && $ResBus3) {
		// Si es una FIEL.
		$Valid_EsFIEL = 0;
	} else {
		// No es una FIEL.
		$Valid_EsFIEL = 1;
	}
} else {

	// Error.
	$Valid_EsFIEL = 1;
}


# VERIFICAR VIGENCIA DE LA FIEL. #######################################################################################################################################

$StatusVigencia = "";
$FechaActual = date("Y/m/d");

if ($Valid_EsFIEL == 0) {

	$datosFIEL = file_get_contents($NomArch_DatosFIEL);

	$CadABusc1 = "Not Before:";
	$pos1 = strpos($datosFIEL, $CadABusc1);

	$CadABusc2 = "Not After :";
	$pos2 = strpos($datosFIEL, $CadABusc2);

	$Fecha1 = trim(substr($datosFIEL, $pos1 + 12, 24));
	$Fecha2 = trim(substr($datosFIEL, $pos2 + 12, 24));

	$PrimerFecha = FIEL_ProcesFec($Fecha1);
	$SegundaFecha = FIEL_ProcesFec($Fecha2);

	if ($FechaActual >= $PrimerFecha && $FechaActual <= $SegundaFecha) {
		$StatusVigencia = "VIGENTE";
	} else {
		$StatusVigencia = "CADUCO";
	}
}



# OBTENER DATOS DE LA FIEL (no. de certificado, nombre y RFC). #############################################################

# Obtener el número de certificado.
$Comando_NoCert = "x509 -in " . $file_cer_pem . " -noout -serial";
$NoCert = exec('openssl ' . $Comando_NoCert, $arr, $status);
$NoCert = ConvANum($NoCert);
$NoCert = trim(ExtraeNoCer($NoCert));


# Obtener la Razon social y RFC.
$Comando_DatosContrib = "x509 -in " . $file_cer_pem . " -noout -subject -nameopt oneline,-esc_msb";
$NomProp = exec('openssl ' . $Comando_DatosContrib, $arr, $status);

if ($status === 0) {

	$ArraySubject = explode(",", $NomProp);
	$ArrayNom = explode("=", $ArraySubject[1]);

	$Nombre   = trim($ArrayNom[1]);
	$ArrayRFC = explode("=", $ArraySubject[5]);
	$RFC      = trim($ArrayRFC[1]);

	$Valid_ObtenDatsFIEL = 0;
} else {

	$Valid_ObtenDatsFIEL = 1;
}

#############################################################################################################################



// if ($Valid_ApertArchsFIEL == 1 || $Valid_EsFIEL == 1 || $Valid_ObtenDatsFIEL == 1 || $StatusVigencia == 'CADUCO') {
//     unlink($NomArch_DatosFIEL);

//     $response = [
//         "Valid_ApertArchsFIEL"    => $Valid_ApertArchsFIEL,
//         "Valid_EsFIEL"            => $Valid_EsFIEL,
//         "Valid_ObtenDatsFIEL"     => $Valid_ObtenDatsFIEL,
//         "StatusVigencia"          => $StatusVigencia,
//         "FechaActual"             => $FechaActual
//     ];
//     header($_SERVER["SERVER_PROTOCOL"] . ' 400 Bad Request', true, 400);
//     echo json_encode($response);
//     exit;
// }


## RECUPERANDO DATOS POR EL MÉTODO POST ########################################
$DescripDoc = "";
$Carpeta = 'Documentos_Firmados';
if (!file_exists($Carpeta)) mkdir("./" . $Carpeta, 0700);

$NomArch = $FolioDoc;
if (!file_exists($Carpeta . "/" . $NomArch)) mkdir("./" . $Carpeta . "/" . $NomArch, 0700);


## ASIGNACIÓN DE VALORES A VARIABLES ###########################################

$Fec1 = date("d/m/Y");
$Fec2 = date("Y/m/d");
$Hora = date("H:i:s");

$URL_ValidDoc = "https://cdt.fgebc.gob.mx//firmar_documento/validar.php";

$FechaHora  = $Fec1 . "-" . $Hora; // Se determina fecha y hora del proceso de firmado.


$NomArchPNG         = $Carpeta . "/" . $NomArch . "/" . $FolioDoc . ".png"; // Nombre del archivo de imagen que se va a crear con el código QR.
$NomArchPDF         = $Carpeta . "/" . $NomArch . "/" . $FolioDoc . ".pdf"; // Nombre del archivo PDF que se va a crear.
$NomArchXML         = $Carpeta . "/" . $NomArch . "/" . $FolioDoc . ".xml"; // Nombre del archivo XML que se va a crear.
$NomArchLlavePub    = $Carpeta . "/" . $NomArch . "/" . $FolioDoc . ".pub"; // Nombre del archivo Llave pública.
$NomArchTXT         = $Carpeta . "/" . $NomArch . "/" . $FolioDoc . ".txt"; // Nombre del archivo TXT que contiene los datos del proceso de firma.

$NomArchPDF_Firma = $NomArch . "_Firma.pdf"; // Nombre de archivo PDF que contiena la firma.

copy($file_cer_pem, $NomArchLlavePub);
chmod($NomArchLlavePub, 0777);

// Se conforma la cadena a firmar.
$CadenaAFirmar = "DescripDoc:" . $DescripDoc . "|Firmante:" . $Nombre . "|RFC del firmante:" . $RFC . "|No de certificado de la FIEL del firmante:" . $NoCert . "|FechaHora:" . $FechaHora;


## Datos a grabar en archivo .TXT ##############################################
$CadDatsTXT = "<< DATOS DEL PROCESO DE FIRMA ELECTRÓNICA >>.\n";
$CadDatsTXT .= "Fecha de firma:" . $Fec1 . "\n";
$CadDatsTXT .= "Hora de firma: " . $Hora . "\n";
$CadDatsTXT .= "Firmante: " . $Nombre . "\n";
$CadDatsTXT .= "RFC del firmante: " . $RFC . "\n";
$CadDatsTXT .= "No. de certificado de la FIEL del firmante: " . $NoCert . "\n";
$CadDatsTXT .= "Descripción del documento: " . $DescripDoc . "\n";
$CadDatsTXT .= "Folio del documento: " . $FolioDoc . "\n";
$CadDatsTXT .= "Nombre del archivo electrónico (archivo .xml): " . $NomArchXML . "\n";
$CadDatsTXT .= "Nombre del archivo pdf (representación impresa del doc. electrónico): " . $NomArchPDF . "\n";
$CadDatsTXT .= "Nombre del archivo de la Llave pública: " . $NomArchLlavePub . "\n";
$CadDatsTXT .= "Nombre del archivo png con código QR que muestra la URL para validación del documento: " . $NomArchPNG . "\n";
$CadDatsTXT .= "Algoritmo de firmado: SHA512 \n";

$file = fopen($NomArchTXT, "w");
fwrite($file, $CadDatsTXT . PHP_EOL);
fclose($file);
chmod($NomArchTXT, 0777);

copy($NomArchTXT, $NomArchTXT);
chmod($NomArchTXT, 0777);

################################################################################


## PROCESO DE FIRMA ELECTRÓNICA ################################################

// Obtención de la Clave privada de la FIEL desde el archivo .PEM 
$fp = fopen($file_key_pem, "r");
$priv_key = fread($fp, 8192);
fclose($fp);
$pkeyid = openssl_get_privatekey($priv_key);

// Se procede a firmar electrónicamente la cadena previamente conformada. La variable $sigantura es la firma digital o electrónica.
openssl_sign($CadenaAFirmar, $signature, $pkeyid, OPENSSL_ALGO_SHA512);

// Liberar la clave de la memoria
// openssl_free_key($pkeyid);

#== Se convierte la firma digital a Base 64 ====================================
$FirmaElec = base64_encode($signature); // Firma.

## CREACIÓN DE ARCHIVO DE IMAGEN QR. ###########################################

$filename = $NomArchPNG;
QRcode::png($URL_ValidDoc, $filename, 'H', 3, 2);
chmod($filename, 0777);

## CREACIÓN DE DOCUMENTO PDF. ##################################################

class ConcatPdf extends Fpdi
{

	public $files = array();

	public function setFiles($files)
	{
		$this->files = $files;
	}

	public function concat()
	{
		foreach ($this->files as $file) {

			$pageCount = $this->setSourceFile($file);

			for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
				$pageId = $this->ImportPage($pageNo);
				$s = $this->getTemplatesize($pageId);
				$this->AddPage($s['orientation'], $s);
				$this->useImportedPage($pageId);
			}
		}
	}
}

$fecha = date('d-m-Y H:i:s');
$SendaGRAFS = "images/";

$pdf = new FPDF('P', 'cm', 'Letter');

$pdf->AliasNbPages();

$pdf->AddPage();

$pdf->SetFont('Arial', '', '8');
$pdf->SetTextColor(0, 0, 0); // Color de texto
$pdf->SetFont('arial', '', 12);

$pdf->image($NomArchPNG, 16, 1.8, 4, 4);

// $pdf->SetTextColor(0,0,0);
// $pdf->SetXY(1.5, 2);
// $pdf->Cell(1, 0.5, "Documento: " . $DescripDoc, 0, 1, 'L', 0);

$Y = 0.56;

$pdf->SetFont('arial', 'B', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(1.5, 2 + $Y);
$pdf->Cell(1, 0.5, "Folio: ", 0, 1, 'L', 0);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(1.5 + 1.2, 2 + $Y);
$pdf->Cell(1, 0.5, $FolioDoc, 0, 1, 'L', 0);

$pdf->SetFont('arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(1.5, 2 + ($Y * 2));
$pdf->Cell(1, 0.5, "Firmante: " . $Nombre, 0, 1, 'L', 0);

$pdf->SetXY(1.5, 2 + ($Y * 3));
$pdf->Cell(1, 0.5, "RFC del firmante: " . $RFC, 0, 1, 'L', 0);

$pdf->SetXY(1.5, 2 + ($Y * 4));
$pdf->Cell(1, 0.5, "No. de certificado de la FIEL: " . $NoCert, 0, 1, 'L', 0);

$pdf->SetXY(1.5, 2 + ($Y * 5));
$pdf->Cell(1, 0.5, "Fecha y hora de firma del documento: " . $Fec1 . " - " . $Hora, 0, 1, 'L', 0);

// $pdf->SetXY(1.5,2+($Y*6));
// $pdf->Cell(1, 0.5, utf8_decode("Referencia alfanumérica: "), 0, 1,'L', 0);

// $pdf->SetTextColor(0,0,150);
// $pdf->SetXY(1.5+4.8,2+($Y*6));
// $pdf->Cell(1, 0.5, $RefAlfa, 0, 1,'L', 0);

$pdf->SetFont('arial', 'B', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(1.5, 2 + ($Y * 8));
$pdf->Cell(1, 0.5, utf8_decode("Firma:"), 0, 1, 'L', 0);

$pdf->SetFont('arial', '', 12);
$pdf->SetXY(1.5 + 1.3, 2 + ($Y * 8) + 0.04);
$pdf->MultiCell(17.2, 0.45, utf8_decode($FirmaElec), 0, 'L', 0);

// $pdf->SetFont('arial', '', 11);
// $pdf->SetTextColor(0,0,0);
// $pdf->SetXY(1.5 + 1.3, 9.2);
// $pdf->Cell(1, 0.25, utf8_decode('Algorítmo de firmado: SHA-512, resulatado codificado en Base64.'), 0, 1, 'L', 0);

$pdf->SetFont('arial', 'B', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(1.5, 9.2 + 1);
$pdf->Cell(1, 0.5, utf8_decode("URL de validación del documento: "), 0, 1, 'L', 0);

$pdf->SetFont('arial', '', 12);
$pdf->SetXY(1.5, 9.2 + 1 + 0.6);
$pdf->Cell(1, 0.5, utf8_decode($URL_ValidDoc), 0, 1, 'L', 0);

// Se guarda el documento PDF en el servidor.
$pdf->Output($NomArchPDF_Firma, 'F');
chmod($NomArchPDF_Firma, 0777);


## CREACIÓN DE ARCHIVO .XML ####################################################

$xml  = new DOMdocument('1.0', 'UTF-8');

$root = $xml->createElement("documento");
$root = $xml->appendChild($root);

$datsDoc = $xml->createElement("DatosDelDocumento");
$datsDoc = $root->appendChild($datsDoc);

cargaAtt(
	$datsDoc,
	array(
		"FechaDeFirma" => "$Fec1",
		"HoraDeFirma" => "$Hora",
		"RFC_Firmante" => "$RFC",
		"NoCertificadoFIEL" => "$NoCert",
		"DescripDoc" => "$DescripDoc",
		"FolioDoc" => "$FolioDoc",
		"NomArchXML" => "$NomArchXML",
		"NomArchPDF" => "$NomArchPDF",
		"NomArchLlavePub" => "$NomArchLlavePub",
		"NomArchQR" => "$NomArchPNG",
		"AlgoritmoFirma" => "SHA512"
	)
);


$firmaDigital = $xml->createElement("FirmaDigital");
$firmaDigital = $root->appendChild($firmaDigital);

cargaAtt(
	$firmaDigital,
	array(
		"FechaHoraCertif" => "$FechaHora",
		"CadenaFirmada" => "$CadenaAFirmar",
		"FirmaBase64" => "$FirmaElec"
	)
);

$cfdi = $xml->saveXML();
$xml->formatOutput = true;
$xml->save($NomArchXML);
unset($xml);

chmod($NomArchXML, 0777);



## CONCATENAR DOCS. PDF ########################################################

$pdf = new ConcatPdf();
$pdf->setFiles(array($PDF_file, $NomArchPDF_Firma));
$pdf->concat();

$pdf->Output('F', $NomArchPDF);
chmod($NomArchPDF, 0777);


// == Comprimiendo archivos ====================================================

copy($file_cer_pem, $NomArchLlavePub);
copy($NomArchXML, $NomArchXML);

chmod($NomArchLlavePub, 0777);
chmod($NomArchXML, 0777);

$NomArchZIP = $Carpeta . "/" . $NomArch . "/" . $FolioDoc . ".zip";

$archive = new PclZip($NomArchZIP);
// $v_list = $archive->add($NomArchLlavePub, PCLZIP_OPT_REMOVE_PATH, 'public');
// $v_list = $archive->add($NomArchPDF, PCLZIP_OPT_REMOVE_PATH, 'public');
// $v_list = $archive->add($NomArchXML, PCLZIP_OPT_REMOVE_PATH, 'public');
// $v_list = $archive->add($NomArchTXT, PCLZIP_OPT_REMOVE_PATH, 'public');
$v_list = $archive->add($NomArchLlavePub);
$v_list = $archive->add($NomArchPDF);
$v_list = $archive->add($NomArchXML);
$v_list = $archive->add($NomArchTXT);


chmod($NomArchZIP, 0777);

rename($NomArchZIP, $NomArchZIP);
rename($NomArchPDF, $NomArchPDF);

unlink($NomArchLlavePub);
unlink($NomArchXML);
unlink($NomArchTXT);
unlink($NomArchPDF_Firma);
unlink($NomArch_DatosFIEL);

// =============================================================================

## REGRESAR PARÁMETROS. ########################################################

$response = [
	"NomArchPNG"    => $NomArchPNG,
	"NomArchPDF"    => $NomArchPDF,
	"NomArchZIP"    => $NomArchZIP,
];
echo json_encode($response);
exit;

### FIN DEL SCRIPT ###




## FUNCIONES ###################################################################


function cargaAtt(&$nodo, $attr)
{
	global $xml;
	foreach ($attr as $key => $val) {
		$val = trim($val);
		if (strlen($val) > 0) {
			$nodo->setAttribute($key, $val);
		}
	}
}


function ProcesarCadena($str)
{

	$textoLimpio = preg_replace('([^A-Za-z0-9 áéíóúÁÉÍÓÚ])', '', substr($str, 0, 300));

	$Cadena = mb_strtolower($textoLimpio, 'UTF-8');

	$ArrayCad = explode(" ", $Cadena);

	$NomArch = "";

	foreach ($ArrayCad as $data) {

		$NomArch .= ucfirst($data);
	}

	return $NomArch;
}



function ConvANum($str)
{
	$legalChars = "%[^0-9\-\. ]%";
	$str        = preg_replace($legalChars, "", $str);
	return $str;
}

function ExtraeNoCer($Cad)
{
	$Cad1 = $Cad;
	$Cad2 = "";
	while (strlen($Cad1) > 0) {
		$Cad2 .= substr($Cad1, 1, 1);
		$Cad1 = substr($Cad1, 2, strlen($Cad1) - 2);
	}
	return $Cad2;
}

function FIEL_ProcesFec($Fecha)
{
	$date = new DateTime($Fecha);
	$Annio = $date->format('Y') . "/" . $date->format('m') . "/" . $date->format('d');
	return $Annio;
}

function extractPublicFile($dir)
{
	return explode('/', $dir)[1];
}
