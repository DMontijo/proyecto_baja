<?php
header('Content-Type: text/html; charset=UTF-8');

echo '<div style="font-size: 14pt; color: #6A0888; margin-bottom: 10px; margin-top: 8px;">';
echo 'FIRMA ELECTRÓNICA DE DOCUMENTOS CON FIEL.';
echo '</div>';
echo '<div style="font-size: 14pt; color: #000000; margin-bottom: 18px; margin-top: 8px;">';
echo 'PROCESO PARA VALIDAR UNA CADENA DE TEXTO FIRMADA ELECTRÓNICAMENTE.';
echo '</div>';

# Configuración de zona horaria
date_default_timezone_set('America/Mexico_City'); 

// Asignación de valores a variables. ==========================================

$Senda_Archs_pem  = "archs_pem/";
$Senda_Archs_Firmados = "archs_firmados/";
    
$file_cer   = "rutr7201209h5.cer.pem"; // Nombre del archivo .cer.pem 
$NomArchXML = "ArchivoFirmado.xml"; // Nombre del archivo .xml 


#== Obteniendo datos del archivo .XML ==========================================

$xml = file_get_contents($Senda_Archs_Firmados.$NomArchXML);

$DOM = new DOMDocument('1.0', 'utf-8');
$DOM->preserveWhiteSpace = FALSE;
$DOM->loadXML($xml);

$params = $DOM->getElementsByTagName('FirmaDigital');
foreach ($params as $param) {
   $FirmaBase64 = $param->getAttribute('FirmaBase64');
   $CadenaFirmada = $param->getAttribute('CadenaFirmada');
}   

    echo '<div style="font-size: 14pt; color: #000099;">';
    echo 'Archivo XML obtenido:';
    echo '</div>';
    echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 10px;">';
    echo htmlspecialchars($xml);
    echo '</div>';

    echo '<div style="font-size: 14pt; color: #000099;">';
    echo 'Cadena de texto extraida del archivo XML:';
    echo '</div>';
    echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 10px;">';
    echo $CadenaFirmada;
    echo '</div>';


    echo '<div style="font-size: 14pt; color: #000099;">';
    echo 'Firma electrónica codificada en Base64, obtenida del archivo XML:';
    echo '</div>';
    echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 10px;">';
    echo $FirmaBase64;
    echo '</div>';

$signature = base64_decode($FirmaBase64);

    echo '<div style="font-size: 14pt; color: #000099;">';
    echo 'Firma electrónica decodificada de Base64:';
    echo '</div>';
    echo '<div style="font-size: 13pt; color: #5C5C5C;">';
    echo $signature;
    echo '</div>';


    
// se asume que $data y $signature contienen la información y la firma

// traer la clave pública desde el certifiado y prepararla
$fp = fopen($Senda_Archs_pem.$file_cer, "r");
$cert = fread($fp, 8192);
fclose($fp);
$pubkeyid = openssl_get_publickey($cert);


// establecer si la firma es correcta o no
$ok = openssl_verify($CadenaFirmada, $signature, $pubkeyid, OPENSSL_ALGO_SHA512);

    echo '<div style="font-size: 14pt; color: #000099;">';
    echo 'Resultado de la validación:';
    echo '</div>';

if ($ok == 1) {

    echo '<div style="font-size: 16pt; color: #088A08; margin-bottom: 300px;">';
    echo 'La cadena verificada es válida, no se encontraron alteraciones en su estructura.';
    echo '</div>';
    
} elseif ($ok == 0) {
    
    echo '<div style="font-size: 16pt; color: #A70202; margin-bottom: 300px;">';
    echo 'La cadena verificada no es válida, se encontraron alteraciones en su estructura.';
    echo '</div>';
    
} else {
    
    echo '<div style="font-size: 16pt; color: #A70202; margin-bottom: 300px;">';
    echo 'Error en el proceso de verificación.';
    echo '</div>';
}
// libera la clave de la memoria
openssl_free_key($pubkeyid);    


### FIN DEL SCRIPT ###


