<?php
header("Content-Type: application/xml");
use setasign\Fpdi\Fpdi;
require("lib/pclzip.lib.php");
include("qrlib/qrlib.php");
include("fpdf/fpdf.php");
require_once('FPDI/src/autoload.php');

date_default_timezone_set('America/Mexico_City'); 


## RECUPERANDO DATOS POR EL MÉTODO POST ########################################
$Nombre = $_POST["Nombre"];
$RFC    = $_POST["RFC"];
$NoCert = $_POST["NoCert"];
$FIEL_password = $_POST["FIEL_password"];
$RefAlfa = $_POST["RefAlfa"];
$NomArchPDF_Original = $_POST["NomArchPDF"]; 
$DescripDoc = $_POST["DescripDoc"]; 
$NomArch = ProcesarCadena($DescripDoc);


## ASIGNACIÓN DE VALORES A VARIABLES ###########################################

$Fec1 = date("d/m/Y");
$Fec2 = date("Y/m/d");
$Hora = date("H:i:s");

$URL_ValidDoc = "https://cdt.fgebc.gob.mx/firmas/validardocumentos.php";

$Senda_Archs_pem  = "archs_pem/";
$Senda_Archs_Firmados = "archs_firmados/";
$Senda_Archs_PDF  = "archs_pdf/";

$file_key_pem = $RefAlfa.".key.pem";  // Nombre del archivo .key.pem
$file_cer_pem = $RefAlfa.".cer.pem";  // Nombre del archivo .cer.pem

$FechaHora  = $Fec1 . "-" . $Hora; // Se determina fecha y hora del proceso de firmado.

$FolioDoc = mt_rand(1000, 9999); // Se crea un número aleatorio como número de documento. El programador puede asignar el número de folio se asigne por sistema.

$NomArchPNG = $NomArch."_".$FolioDoc.".png"; // Nombre del archivo de imagen que se va a crear con el código QR.
$NomArchPDF = $NomArch."_".$FolioDoc.".pdf"; // Nombre del archivo PDF que se va a crear.
$NomArchXML = $NomArch."_".$FolioDoc.".xml"; // Nombre del archivo XML que se va a crear.
$NomArchLlavePub = $NomArch."_".$FolioDoc.".pub"; // Nombre del archivo Llave pública.
$NomArchTXT = $NomArch."_".$FolioDoc.".txt"; // Nombre del archivo TXT que contiene los datos del proceso de firma.

$NomArchPDF_Firma = $RefAlfa."_Firma.pdf"; // Nombre de archivo PDF que contiena la firma.

copy($Senda_Archs_pem.$file_cer_pem, $Senda_Archs_Firmados.$NomArchLlavePub);
chmod($Senda_Archs_Firmados.$NomArchLlavePub, 0777);

// Se conforma la cadena a firmar.
$CadenaAFirmar = "DescripDoc:".$DescripDoc."|Firmante:".$Nombre."|RFC del firmante:".$RFC."|No de certificado de la FIEL del firmante:".$NoCert."|FechaHora:".$FechaHora;


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

copy($NomArchTXT, $Senda_Archs_Firmados.$NomArchTXT);
chmod($Senda_Archs_Firmados.$NomArchTXT, 0777);

################################################################################


## PROCESO DE FIRMA ELECTRÓNICA ################################################
    
// Obtención de la Clave privada de la FIEL desde el archivo .PEM 
$fp = fopen($Senda_Archs_pem.$file_key_pem, "r");
$priv_key = fread($fp, 8192);
fclose($fp);
$pkeyid = openssl_get_privatekey($priv_key);

// Se procede a firmar electrónicamente la cadena previamente conformada. La variable $sigantura es la firma digital o electrónica.
openssl_sign($CadenaAFirmar, $signature, $pkeyid, OPENSSL_ALGO_SHA512);

// Liberar la clave de la memoria
openssl_free_key($pkeyid);

#== Se convierte la firma digital a Base 64 ====================================
$FirmaElec = base64_encode($signature); // Firma.

## CREACIÓN DE ARCHIVO DE IMAGEN QR. ###########################################
        
$filename = $Senda_Archs_Firmados.$NomArchPNG;
QRcode::png($URL_ValidDoc, $filename, 'H', 3, 2);
chmod($filename, 0777);

## CREACIÓN DE DOCUMENTO PDF. ##################################################

class ConcatPdf extends Fpdi{
    
    public $files = array();

    public function setFiles($files)
    {
        $this->files = $files;
    }

    public function concat()
    {
        foreach($this->files AS $file) {
            
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

$pdf=new FPDF('P','cm','Letter');

$pdf->AliasNbPages();

$pdf->AddPage();

$pdf->SetFont('Arial','','8');
$pdf->SetTextColor(0,0,0); // Color de texto
$pdf->SetFont('arial','',12);

$pdf->image($Senda_Archs_Firmados.$NomArchPNG, 16, 1.8, 4, 4);

$pdf->SetTextColor(102,102,102);
$pdf->SetXY(1.5,2);
$pdf->Cell(1, 0.5, "Documento: " . $DescripDoc, 0, 1,'L', 0);

$Y = 0.56;

$pdf->SetTextColor(102,102,102);
$pdf->SetXY(1.5,2+$Y);
$pdf->Cell(1, 0.5, "Folio: ", 0, 1,'L', 0);

$pdf->SetTextColor(150,0,0);
$pdf->SetXY(1.5+1.2,2+$Y);
$pdf->Cell(1, 0.5, $FolioDoc, 0, 1,'L', 0);

$pdf->SetTextColor(102,102,102);
$pdf->SetXY(1.5,2+($Y*2));
$pdf->Cell(1, 0.5, "Firmante: " . $Nombre, 0, 1,'L', 0);

$pdf->SetXY(1.5,2+($Y*3));
$pdf->Cell(1, 0.5, "RFC del firmante: " . $RFC, 0, 1,'L', 0);

$pdf->SetXY(1.5,2+($Y*4));
$pdf->Cell(1, 0.5, "No. de certificado de la FIEL: " . $NoCert, 0, 1,'L', 0);

$pdf->SetXY(1.5,2+($Y*5));
$pdf->Cell(1, 0.5, "Fecha y hora de firma del documento: " . $Fec1 . " - " . $Hora, 0, 1,'L', 0);

$pdf->SetXY(1.5,2+($Y*6));
$pdf->Cell(1, 0.5, utf8_decode("Referencia alfanumérica: "), 0, 1,'L', 0);

$pdf->SetTextColor(0,0,150);
$pdf->SetXY(1.5+4.8,2+($Y*6));
$pdf->Cell(1, 0.5, $RefAlfa, 0, 1,'L', 0);

$pdf->SetTextColor(102,102,102);
$pdf->SetXY(1.5,2+($Y*8));
$pdf->Cell(1, 0.5, utf8_decode("Firma:"), 0, 1,'L', 0);

$pdf->SetFont('arial','',11);
$pdf->SetXY(1.5+1.3,2+($Y*8)+0.04);
$pdf->MultiCell(17.2, 0.45, utf8_decode($FirmaElec), 0, 'L', 0);

$pdf->SetFont('arial','',11);
$pdf->SetTextColor(102,102,102);
$pdf->SetXY(1.5+1.3,9.2);
$pdf->Cell(1, 0.25, utf8_decode('Algorítmo de firmado: SHA-512, resultado codificado en Base64.'), 0, 1,'L', 0);

$pdf->SetTextColor(102,102,102);
$pdf->SetXY(1.5,9.2+1);
$pdf->Cell(1, 0.5, utf8_decode("URL de validación del documento: "), 0, 1,'L', 0);

$pdf->SetXY(1.5+1.3,9.2+1+0.6);
$pdf->Cell(1, 0.5, utf8_decode($URL_ValidDoc), 0, 1,'L', 0);

// Se guarda el documento PDF en el servidor.
$pdf->Output($NomArchPDF_Firma, 'F');
chmod ($NomArchPDF_Firma,0777);


## CREACIÓN DE ARCHIVO .XML ####################################################

$xml  = new DOMdocument('1.0', 'UTF-8'); 

$root = $xml->createElement("documento");
$root = $xml->appendChild($root); 

$datsDoc = $xml->createElement("DatosDelDocumento");
$datsDoc = $root->appendChild($datsDoc); 

cargaAtt($datsDoc, array(
        "FechaDeFirma"=>"$Fec1", 
        "HoraDeFirma"=>"$Hora", 
        "RFC_Firmante"=>"$RFC", 
        "NoCertificadoFIEL"=>"$NoCert", 
        "DescripDoc"=>"$DescripDoc", 
        "FolioDoc"=>"$FolioDoc", 
        "NomArchXML"=>"$NomArchXML", 
        "NomArchPDF"=>"$NomArchPDF", 
        "NomArchLlavePub"=>"$NomArchLlavePub", 
        "NomArchQR"=>"$NomArchPNG", 
        "AlgoritmoFirma"=>"SHA512" 
    )
);


$firmaDigital = $xml->createElement("FirmaDigital");
$firmaDigital = $root->appendChild($firmaDigital); 

cargaAtt($firmaDigital, array(
        "FechaHoraCertif"=>"$FechaHora",
        "CadenaFirmada"=>"$CadenaAFirmar",
        "FirmaBase64"=>"$FirmaElec"
    )
);

$cfdi = $xml->saveXML();
$xml->formatOutput = true;             
$xml->save($Senda_Archs_Firmados.$NomArchXML); 
unset($xml);    
    
chmod($Senda_Archs_Firmados.$NomArchXML, 0777); 



## CONCATENAR DOCS. PDF ########################################################

$pdf = new ConcatPdf();
$pdf->setFiles(array($Senda_Archs_PDF.$NomArchPDF_Original, $NomArchPDF_Firma));
$pdf->concat();

$pdf->Output('F', $NomArchPDF);
chmod ($NomArchPDF,0777);


// == Comprimiendo archivos ====================================================

copy($Senda_Archs_pem.$file_cer_pem, $NomArchLlavePub);
copy($Senda_Archs_Firmados.$NomArchXML, $NomArchXML);

chmod($NomArchLlavePub, 0777);
chmod($NomArchXML, 0777);

$NomArchZIP = $NomArch."_".$FolioDoc.".zip";

$archive = new PclZip($NomArchZIP);
$v_list = $archive->add($NomArchLlavePub);
$v_list = $archive->add($NomArchPDF);
$v_list = $archive->add($NomArchXML);
$v_list = $archive->add($NomArchTXT);
                        
chmod($NomArchZIP, 0777);  

rename($NomArchZIP, $Senda_Archs_Firmados.$NomArchZIP);
rename($NomArchPDF, $Senda_Archs_Firmados.$NomArchPDF);

unlink($NomArchLlavePub);
unlink($NomArchXML);
unlink($NomArchTXT);
unlink($NomArchPDF_Firma);

// =============================================================================

## REGRESAR PARÁMETROS. ########################################################

$Param = "<param NomArchPNG='$NomArchPNG' NomArchPDF='$NomArchPDF' NomArchZIP='$NomArchZIP' />\n";
        
echo "<datos>\n$Param</datos>";

### FIN DEL SCRIPT ###





## FUNCIONES ###################################################################

function cargaAtt(&$nodo, $attr){
    global $xml;
    foreach ($attr as $key => $val){
        $val = trim($val);
        if (strlen($val)>0){
            $nodo->setAttribute($key,$val);
        }
    }
}  


function ProcesarCadena($str){
    
    $textoLimpio = preg_replace('([^A-Za-z0-9 áéíóúÁÉÍÓÚ])', '', substr($str,0,300));
    
    $Cadena = mb_strtolower($textoLimpio, 'UTF-8');
    
    $ArrayCad = explode(" ", $Cadena);
    
    $NomArch = "";
    
    foreach ($ArrayCad as $data){
        
        $NomArch .= ucfirst($data);
    }
    
    return $NomArch;
}







