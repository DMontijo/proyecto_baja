<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


header("Content-Type: application/xml");

$Archivo = "lista_docs_pdf.xml";
$CodXML = "";

$FecEmision = "";

$xml = file_get_contents($Archivo);

#== 2. Obteniendo datos del archivo .XML ===========================

$DOM = new DOMDocument('1.0', 'utf-8');
$DOM->preserveWhiteSpace = FALSE;
$DOM->loadXML($xml);

$params = $DOM->getElementsByTagName('rst');
foreach ($params as $param) {

    $NomArchPDF = $param->getAttribute('NomArchPDF');
    $DescripDoc = $param->getAttribute('DescripDoc');

    $CodXML .= "<rst"
            . " NomArchPDF='$NomArchPDF'"
            . " DescripDoc='$DescripDoc'"
            . " />\n";    
}            


echo "<datos>\n".$CodXML."</datos>";        






