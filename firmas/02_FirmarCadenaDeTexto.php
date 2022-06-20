<?php
header('Content-Type: text/html; charset=UTF-8');
include("qrlib/qrlib.php");

echo '<div style="font-size: 14pt; color: #6A0888; margin-bottom: 10px; margin-top: 8px;">';
echo 'FIRMA ELECTRÓNICA DE DOCUMENTOS CON FIEL.';
echo '</div>';
echo '<div style="font-size: 14pt; color: #000000; margin-bottom: 18px; margin-top: 8px;">';
echo 'PROCESO PARA FIRMAR ELECTRÓNICAMENTE UNA CADENA DE TEXTO.';
echo '</div>';

# Configuración de zona horaria
date_default_timezone_set('America/Mexico_City'); 

$Senda_Archs_pem  = "archs_pem/"; // Carpeta en donde se encuentran los archivos .pem
$Senda_Archs_Firmados = "archs_firmados/";  // Carpeta en donde se encuentran los archivos firmados.

// Asignación de valores a variables. ==========================================
    
$file_cer   = "rutr7201209h5.cer.pem"; // Nombre del archivo .cer.pem 
$file_key   = "rutr7201209h5.key.pem"; // Nombre del archivo .cer.key

$NomArchXML = "ArchivoFirmado.xml"; // Nombre del archivo .xml (documento electrónico).
$NomArchPNG = "Archivo_QR.png"; // Nombre del archivo .png con el código QR.
       
$Fecha = date("d/m/Y");
$Hora  = date("H:i:s");
$Documento = "CERTIFICADO";
$FolioDoc = "002565";
$Institucion = "UAM - UNIVERSIDAD AUTONOMA METROPOLITANA";
$Egresado = "CARDENAS MARTINEZ ALEXIS ALEJANDRO";
$CURP = "CAMA070822HMCRRLA8";

$URL_ValidDoc = "Pegar aquí la URL para validar documentos firmados";

$CadenaAFirmar = $Fecha."|".$Hora."|".$Documento."|".$FolioDoc."|".$Institucion."|".$Egresado."|".$CURP;

    #=== Muestra la firma ya codificada en Base64 (opcional a mostrar) =========
    echo '<div style="font-size: 14pt; color: #000099;">';
    echo 'Cadena a firmar:';
    echo '</div>';
    echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 10px;">';
    echo $CadenaAFirmar;
    echo '</div>';


// traer la clave privada desde el archivo y prepararla. =======================
$fp = fopen($Senda_Archs_pem.$file_key, "r");
$priv_key = fread($fp, 8192);
fclose($fp);
$pkeyid = openssl_get_privatekey($priv_key);

// Generar la firma ============================================================
openssl_sign($CadenaAFirmar, $signature, $pkeyid, OPENSSL_ALGO_SHA512);

// Liberar la clave de la memoria ==============================================
openssl_free_key($pkeyid);

    echo '<div style="font-size: 14pt; color: #000099;">';
    echo 'Firma electrónica sin encriptar:';
    echo '</div>';
    echo '<div style="font-size: 13pt; color: #5C5C5C;">';
    echo $signature;
    echo '</div>';


#== Se convierte la firma digital a Base 64 ==========================
$FirmaElec = base64_encode($signature); // Firma.
    
    echo '<div style="font-size: 14pt; color: #000099;">';
    echo 'Firma electrónica encriptada en Base64:';
    echo '</div>';
    echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 18px;">';
    echo $FirmaElec;
    echo '</div>';
    
    
## CREACIÓN DEL ARCHIVO .XML (documento electrónico) ###########################

$xml  = new DOMdocument('1.0', 'UTF-8'); 

$root = $xml->createElement("documento");
$root = $xml->appendChild($root); 

$datsDoc = $xml->createElement("DatosDelDocumento");
$datsDoc = $root->appendChild($datsDoc); 

$firmaDigital = $xml->createElement("FirmaDigital");
$firmaDigital = $root->appendChild($firmaDigital); 

cargaAtt($firmaDigital, array(
        "CadenaFirmada"=>"$CadenaAFirmar",
        "FirmaBase64"=>"$FirmaElec"
    )
);

$ArchXML = $xml->saveXML();
$xml->formatOutput = true;             
$xml->save($Senda_Archs_Firmados.$NomArchXML); // Guarda el archivo .XML
unset($xml);    
    
chmod($Senda_Archs_Firmados.$NomArchXML, 0777); 

    echo '<div style="font-size: 14pt; color: #000099;">';
    echo 'Archivo XML resultante:';
    echo '</div>';
    echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 10px;">';
    echo htmlspecialchars($ArchXML);
    echo '</div>';

## CREACIÓN DEL ARCHIVO CON CÓDIGO QR ##########################################
$filename = $Senda_Archs_Firmados.$NomArchPNG;
QRcode::png($URL_ValidDoc, $filename, 'H', 3, 2);
chmod($filename, 0777);      
    
    echo '<div style="font-size: 14pt; color: #000099;">';
    echo 'Código QR resultante:';
    echo '</div>';
    echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 300px;">';
    echo '<img src="'.$filename.'" width="180" height="180" alt="QR"/>';
    echo '</div>';
    
### FIN DEL SCRIPT ###



// Función que agrega el atributo al archivo .XML ==============================
function cargaAtt(&$nodo, $attr){
    global $xml;
    foreach ($attr as $key => $val){
        $val = trim($val);
        if (strlen($val)>0){
            $nodo->setAttribute($key,$val);
        }
    }
 }  

 
 
 
 