<?php
header("Content-Type: application/xml");
date_default_timezone_set('America/Mexico_City'); 

$RefAlfa = $_POST["RefAlfa"];

// Asignación de valores a variables. ==========================================

$Senda_Archs_Valid  = "archs_valid/";
    
$NomArchXML = $RefAlfa.".xml"; // Nombre del archivo .XML 
$file_pub   = $RefAlfa.".pub"; // Nombre del archivo .PUB

$Resp = "";
$CodErr = 0;

#== Obteniendo datos del archivo .XML y .PUB ===================================

$xml = file_get_contents($Senda_Archs_Valid.$NomArchXML);

$DOM = new DOMDocument('1.0', 'utf-8');
$DOM->preserveWhiteSpace = FALSE;
$DOM->loadXML($xml);

$params = $DOM->getElementsByTagName('FirmaDigital');
foreach ($params as $param) {
   $FirmaBase64 = $param->getAttribute('FirmaBase64');
   $CadenaFirmada = $param->getAttribute('CadenaFirmada');
}   

$signature = base64_decode($FirmaBase64);
    
// se asume que $data y $signature contienen la información y la firma

// traer la clave pública desde el certifiado y prepararla
$fp = fopen($Senda_Archs_Valid.$file_pub, "r");
$cert = fread($fp, 8192);
fclose($fp);
$pubkeyid = openssl_get_publickey($cert);

// establecer si la firma es correcta o no
$ok = openssl_verify($CadenaFirmada, $signature, $pubkeyid, OPENSSL_ALGO_SHA512);

if ($ok == 1) {
    
    $CodErr = 0;
    $Resp = 'El documento es válido, no se encontraron alteraciones en su estructura.';
    
} elseif ($ok == 0) {
    
    $CodErr = 1;
    $Resp = 'El documento no es válido, se detectaron alteraciones en su estructura.';
    
} else {
    
    $CodErr = 2;
    $Resp = 'Error en el proceso de verificación.';
}
// libera la clave de la memoria
openssl_free_key($pubkeyid);    


$Param = "<param CodErr='$CodErr' Resp='$Resp' />\n";

echo "<datos>\n$Param</datos>";


