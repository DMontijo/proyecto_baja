<?php
date_default_timezone_set('America/Mexico_City'); 
header('Content-Type: text/html; charset=UTF-8');
$key            = $_FILES['ArchFIELkey'];
$pdf            = $_FILES['ArchFIELpdf'];
$cer            = $_FILES['ArchFIELcer'];
$FIEL_password  = $_POST["ClaveFIEL"];

echo $cer;
die();

$RefAlfa = $_POST["RefAlfa"];

$Senda_Archs_pem  = "archs_pem/";
$Senda_Archs_txt  = "archs_txt/";
$Senda_Archs_FIEL = "archs_fiel/";

$FIEL_file_key = $RefAlfa.".key";  // Nombre del archivo .key de la FIEL (Clave privada).
$FIEL_file_cer = $RefAlfa.".cer";  // Nombre del archivo .cer de la FIEL (Clave pública).

$file_key_pem = $RefAlfa.".key.pem";  // Nombre del archivo .key.pem
$file_cer_pem = $RefAlfa.".cer.pem";  // Nombre del archivo .cer.pem 

$NomArch_DatosFIEL  = $RefAlfa.".txt";

$Valid_ApertArchsFIEL = 0;
$Valid_EsFIEL = 0;
$Valid_ObtenDatsFIEL = 0;

$Nombre = "";
$RFC = "";


if (file_exists($Senda_Archs_pem."/".$file_key_pem)) {
    unlink($Senda_Archs_pem."/".$file_key_pem);
}    

if (file_exists($Senda_Archs_pem."/".$file_cer_pem)) {
    unlink($Senda_Archs_pem."/".$file_cer_pem);
}  


# OBTENIENDO ARCHIVOS .PEM #############################################################################################################################################

    //==========================================================================
    # Obtener el archivo .key.pem del archivo .key (Llave privada).
     
    $Comando_key_pem = "pkcs8 -inform DER -in ".$Senda_Archs_FIEL.$FIEL_file_key." -passin pass:$FIEL_password -out ".$Senda_Archs_pem.$file_key_pem;
    
    exec('openssl '.$Comando_key_pem, $arr, $status);
  
    if ($status===0){

        # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
        chmod($Senda_Archs_pem.$file_key_pem, 0777);     
        
        // Archivo correctamente procesado.
        $Valid_ApertArchsFIEL = 0;
    }else{
        // Error;
        $Valid_ApertArchsFIEL = 1;
    }


    //==========================================================================
    # Obtener el archivo .cer.pem del archivo .cer
    
    $Comando_cer_pem = "x509 -inform DER -outform PEM -in ".$Senda_Archs_FIEL.$FIEL_file_cer." -passin pass:$FIEL_password -out ".$Senda_Archs_pem.$file_cer_pem;
    
    exec('openssl '.$Comando_cer_pem, $arr, $status);
    
    if ($status===0){
        
        # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
         chmod($Senda_Archs_pem.$file_cer_pem, 0777);     
         
        // Archivo correctamente procesado.
        $Valid_ApertArchsFIEL = 0;
    }else{
        // Error.
        $Valid_ApertArchsFIEL = 1;
    }
    

# VERIFICAR SI LOS ARCHIVOS CORRESPONEDEN A UNA FIEL ###################################################################################################################

//===============================================================
    # Obtener datos del archivo .cer.pem y guardarlos en un archivo .txt
    
    $ComandoOpenSSL = "x509 -in ".$Senda_Archs_pem.$file_cer_pem." > ".$Senda_Archs_txt.$NomArch_DatosFIEL." -text";
    
    $cadena = exec('openssl '.$ComandoOpenSSL, $arr, $status);
        
    if ($status==0){
        
        chmod($Senda_Archs_txt.$NomArch_DatosFIEL, 0777);
        
        $sslcert = file_get_contents($Senda_Archs_txt.$NomArch_DatosFIEL);
        $sslcert = array(openssl_x509_parse($sslcert,TRUE));

        foreach ($sslcert as $name => $arrays){

            foreach ($arrays as $title => $value){

                if(is_array($value)){

                    foreach($value as $subtitle => $subvalue){

                        if ($subtitle=="keyUsage"){
                            
                            $ArrayUsos = explode(",", $subvalue);
                        }
                    }
                }
            }
        }
        
        $ResBus1 = false;
        $ResBus2 = false;
        $ResBus3 = false;

        for ($i=0; $i<count($ArrayUsos); $i++){

            if (trim($ArrayUsos[$i])=="Digital Signature"){$ResBus1=true;}
            if (trim($ArrayUsos[$i])=="Data Encipherment"){$ResBus2=true;}
            if (trim($ArrayUsos[$i])=="Key Agreement")    {$ResBus3=true;}
        }
        
        if ($ResBus1 && $ResBus2 && $ResBus3){
            // Si es una FIEL.
            $Valid_EsFIEL = 0;
        }else{
            // No es una FIEL.
            $Valid_EsFIEL = 1;
        }
        
    }else{
        
        // Error.
        $Valid_EsFIEL = 1;
    }


# VERIFICAR VIGENCIA DE LA FIEL. #######################################################################################################################################
    
    $StatusVigencia = "";
    $FechaActual = date("Y/m/d"); 
    
    if ($Valid_EsFIEL==0){

        $datosFIEL = file_get_contents($Senda_Archs_txt.$NomArch_DatosFIEL);

        $CadABusc1 = "Not Before:";
        $pos1 = strpos($datosFIEL, $CadABusc1);

        $CadABusc2 = "Not After :";
        $pos2 = strpos($datosFIEL, $CadABusc2);

        $Fecha1 = trim(substr($datosFIEL, $pos1+12, 24));
        $Fecha2 = trim(substr($datosFIEL, $pos2+12, 24));

        $PrimerFecha = FIEL_ProcesFec($Fecha1);
        $SegundaFecha = FIEL_ProcesFec($Fecha2);

        if ($FechaActual>=$PrimerFecha && $FechaActual<=$SegundaFecha){
            $StatusVigencia = "VIGENTE";
        }else{    
            $StatusVigencia = "CADUCO";
        }
    }
    
    
    

# OBTENER DATOS DE LA FIEL (no. de certificado, nombre y RFC). #############################################################
    
    # Obtener el número de certificado.
    $Comando_NoCert = "x509 -in ".$Senda_Archs_pem.$file_cer_pem." -noout -serial";
    $NoCert = exec('openssl '.$Comando_NoCert, $arr, $status);
    $NoCert = ConvANum($NoCert);
    $NoCert = trim(ExtraeNoCer($NoCert));


    # Obtener la Razon social y RFC.
    $Comando_DatosContrib = "x509 -in ".$Senda_Archs_pem.$file_cer_pem." -noout -subject -nameopt oneline,-esc_msb";
    $NomProp = exec('openssl '.$Comando_DatosContrib, $arr, $status);

    if ($status===0){

        $ArraySubject = explode(",", $NomProp);
        $ArrayNom = explode("=", $ArraySubject[1]);

        $Nombre   = trim($ArrayNom[1]);
        $ArrayRFC = explode("=", $ArraySubject[5]);
        $RFC      = trim($ArrayRFC[1]);

        $Valid_ObtenDatsFIEL = 0;

    }else{

        $Valid_ObtenDatsFIEL = 1;
    }    
    
#############################################################################################################################
    
$Param = "<param RefAlfa='$RefAlfa' NomArchKeyPem='$file_key_pem' NomArchCerPem='$file_cer_pem' Valid_ApertArchsFIEL='$Valid_ApertArchsFIEL' Valid_EsFIEL='$Valid_EsFIEL' Valid_ObtenDatsFIEL='$Valid_ObtenDatsFIEL' NoCert='$NoCert' Nombre='$Nombre' RFC='$RFC' FIEL_password='$FIEL_password' StatusVigencia='$StatusVigencia' FechaActual='$FechaActual' />\n";
        
echo "<datos>\n$Param</datos>";
    
### FIN DEL SCRIPT ###





## FUNCIONES ###################################################################

function ConvANum($str){
  $legalChars = "%[^0-9\-\. ]%";
  $str        = preg_replace($legalChars,"",$str);
  return $str;
}

function ExtraeNoCer($Cad){
    $Cad1 = $Cad;
    $Cad2 = "";
    while (strlen($Cad1) > 0){
        $Cad2 .= substr($Cad1,1,1);
        $Cad1 = substr($Cad1,2,strlen($Cad1)-2);
    }    
    return $Cad2;
}

function FIEL_ProcesFec($Fecha){
    $date = new DateTime($Fecha);
    $Annio = $date->format('Y') . "/" . $date->format('m') . "/" . $date->format('d');
    return $Annio;
}






