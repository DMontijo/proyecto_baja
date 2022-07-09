<?php
header("Content-Type: application/xml");

$DecripDoc = $_POST["DescripDoc"];
$RefAlfa = $_POST["RefAlfa"];
$CadDats = $_POST["CadDats"];
$NomArchPDF = $RefAlfa.".pdf";
$Senda_Archs_PDF  = "archs_pdf/";

$Param = "";
$CodXML = "";

//==============================================================================

$ArrayRegs = explode("|", $CadDats);

for ($i=0; $i<count($ArrayRegs); $i++){
   
    $data = explode("*", $ArrayRegs[$i]);
    
    if (strlen($data[0])>0){
        $CodXML .= "<rst NomArchPDF='".$data[0]."' DescripDoc='".$data[1]."' />\n";    
    }
    
}

$CodXML .= "<rst NomArchPDF='$NomArchPDF' DescripDoc='$DecripDoc' />\n";


$file = fopen("lista_docs_pdf.xml", "w");
fwrite($file, "<datos>\n" . $CodXML . "</datos>" . PHP_EOL);
fclose($file);
chmod("lista_docs_pdf.xml", 0777); 

//==============================================================================


if (file_exists($Senda_Archs_PDF."/".$NomArchPDF)){
    
    $Param = "<param ExisteArch='SI' NomArch='$NomArchPDF' DescripDoc='$DecripDoc' />\n";
    
}else{    
    
    $Param = "<param ExisteArch='NO' NomArch='' DescripDoc='' />\n";
}

echo "<datos>\n$Param</datos>";


