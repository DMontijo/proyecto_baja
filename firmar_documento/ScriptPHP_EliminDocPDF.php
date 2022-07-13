<?php
header("Content-Type: application/xml");

$SendaArchsPDF = "archs_pdf/";

$NomArchPDF = $_POST["NomArchPDF"];
$CadDats = $_POST["CadDats"];
$Ind  = $_POST["Ind"];


unlink($SendaArchsPDF.$NomArchPDF);

//==============================================================================

$ArrayRegs = explode("|", $CadDats);

for ($i=0; $i<count($ArrayRegs); $i++){
   
    $data = explode("*", $ArrayRegs[$i]);
    
    if (strlen($data[0])>0){
        $CodXML .= "<rst NomArchPDF='".$data[0]."' DescripDoc='".$data[1]."' />\n";    
    }
}


$file = fopen("lista_docs_pdf.xml", "w");
fwrite($file, "<datos>\n" . $CodXML . "</datos>" . PHP_EOL);
fclose($file);
chmod("lista_docs_pdf.xml", 0777); 

//==============================================================================

echo "==> " . $NomArchPDF;




