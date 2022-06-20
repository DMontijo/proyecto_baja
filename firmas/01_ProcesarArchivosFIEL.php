<?php

echo '<div style="font-size: 14pt; color: #6A0888; margin-bottom: 10px; margin-top: 8px;">';
echo 'FIRMA ELECTRÓNICA DE DOCUMENTOS CON FIEL.';
echo '</div>';
echo '<div style="font-size: 14pt; color: #000000; margin-bottom: 10px; margin-top: 8px; margin-bottom: 14px;">';
echo 'PROCESOS DE VALIDACIÓN DE ARCHIVOS .KEY Y .CER DE LA FIEL, MAS OBTENCIÓN DE ARCHIVOS .PEM';
echo '</div>';


# Configuración de zona horaria
date_default_timezone_set('America/Mexico_City'); 

$Senda_Archs_pem  = "archs_pem/"; // Carpeta en donde se crearn los archivos .pem
$Senda_Archs_txt  = "archs_txt/"; // Carpeta en donde se crearn los archivos .pem
$SendaFIEL_test   = "fiel_test/"; // Carpeta en donde se archivos de la FIEL de pruebas.

// Asignación de valores a variables. =========================================================================

$FIEL_file_key = "rutr7201209h5.key";  // Nombre del archivo .key de la FIEL (Clave privada).
$FIEL_file_cer = "rutr7201209h5.cer";  // Nombre del archivo .cer de la FIEL (Clave pública).
$FIEL_password = "n93kZ84h"; // Contraseña de la FIEL.

$file_key_pem = "rutr7201209h5.key.pem"; // Nombre del archivo .key.pem a obtener (este archivo se creará al ejecutar este script).
$file_cer_pem = "rutr7201209h5.cer.pem"; // Nombre del archivo .cer.pem a obtener (este archivo se creará al ejecutar este script). 

$NomArch_DatosFIEL  = "Datos_FIEL.txt"; // Nombre del archivo .TXT a donde se guardarán temporalmente los datos obtenidos de la FIEL (el archivo se crea al ejecutar este script).

//==============================================================================

$Valid_ApertArchsFIEL = 0;
$Valid_EsFIEL = 0;
$Valid_ObtenDatsFIEL = 0;

## OBTENIENDO ARCHIVOS .PEM #############################################################################################################################################

    //==========================================================================
    # Obtener el archivo .key.pem del archivo .key (Llave privada).
     
    $Comando_key_pem = "pkcs8 -inform DER -in ".$SendaFIEL_test.$FIEL_file_key." -passin pass:$FIEL_password -out ".$Senda_Archs_pem.$file_key_pem;
    
    echo $Comando_key_pem;
    
    echo "<br><br>";
    
    exec('openssl '.$Comando_key_pem, $arr, $status);
  
    if ($status===0){

        # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
        chmod($Senda_Archs_pem.$file_key_pem, 0777);     
        
        echo 'Archivo .KEY correctamente procesado, el archivo resultante se guardó en la carpeta: archs_pem/  <br>';
        $Valid_ApertArchsFIEL = 0;
    }else{
        echo 'Error';
        $Valid_ApertArchsFIEL = 1;
    }


    //==========================================================================
    # Obtener el archivo .cer.pem del archivo .cer
    echo "<br>";
    
    $Comando_cer_pem = "x509 -inform DER -outform PEM -in ".$SendaFIEL_test.$FIEL_file_cer." -passin pass:$FIEL_password -out ".$Senda_Archs_pem.$file_cer_pem;
    
    exec('openssl '.$Comando_cer_pem, $arr, $status);
    
    if ($status===0){
        
        # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
         chmod($Senda_Archs_pem.$file_cer_pem, 0777);     
         
        echo 'Archivo .CER correctamente procesado, el archivo resultante se guardó en la carpeta: archs_pem/  <br>';
        $Valid_ApertArchsFIEL = 0;
    }else{
        echo 'Error';
        $Valid_ApertArchsFIEL = 1;
    }
    
    
## VERIFICAR SI LOS ARCHIVOS CORRESPONEDEN A UNA FIEL ###################################################################################################################

//===============================================================
    # Obtener datos del archivo .cer.pem y guardarlos en un archivo .txt
    
    $ComandoOpenSSL = "x509 -in ".$Senda_Archs_pem.$file_cer_pem." > ".$Senda_Archs_txt.$NomArch_DatosFIEL." -text";
    
    $cadena = exec('openssl '.$ComandoOpenSSL, $arr, $status);
    
    echo "<br><br>";
    
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
        
        for ($i=0; $i<count($ArrayUsos); $i++){

            echo $ArrayUsos[$i] ."<br>";

            if (trim($ArrayUsos[$i])=="Digital Signature"){$ResBus1=1;}
            if (trim($ArrayUsos[$i])=="Data Encipherment"){$ResBus2=1;}
            if (trim($ArrayUsos[$i])=="Key Agreement")    {$ResBus3=1;}
        }
        
        if ($ResBus1==1 && $ResBus2==1 && $ResBus3==1){
            echo '<h2 style="color: #1B701B;">SÍ ES UNA FIEL</h1>';
            $Valid_EsFIEL = 0;
        }else{
            echo '<h2 style="color: #A70202;">NO ES UNA FIEL</h1>';
            $Valid_EsFIEL = 1;
        }
        
    }else{
        
        echo '<h2>Error</h1>';
        
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

        $Fecha1 = substr($datosFIEL, $pos1+12, 24);
        $Fecha2 = substr($datosFIEL, $pos2+12, 24);

        $PrimerFecha  = FIEL_ProcesFec($Fecha1);
        $SegundaFecha = FIEL_ProcesFec($Fecha2);

        if ($FechaActual>=$PrimerFecha && $FechaActual<=$SegundaFecha){
            $StatusVigencia = "VIGENTE";
        }else{    
            $StatusVigencia = "CADUCO";
        }
        
        echo '<h2>'.$StatusVigencia.'</h1>';
    }    
    
    
    
    
## OBTENER DATOS DE LA FIEL (no. de certificado, nombre y RFC). #############################################################

# Obtener el número de certificado.
    
$Comando_NoCert = "x509 -in ".$Senda_Archs_pem.$file_cer_pem." -noout -serial";
$NoCert = exec('openssl '.$Comando_NoCert, $arr, $status);
$NoCert = ConvANum($NoCert);
$NoCert = trim(ExtraeNoCer($NoCert));

//===============================================================
# Obtener la Razon social y RFC.

$Comando_DatosContrib = "x509 -in ".$Senda_Archs_pem.$file_cer_pem." -noout -subject -nameopt oneline,-esc_msb";
$NomProp = exec('openssl '.$Comando_DatosContrib, $arr, $status);

if ($status===0){
    
    $ArraySubject = explode(",", $NomProp);
    $ArrayNom = explode("=", $ArraySubject[1]);
    $RazSoc   = trim($ArrayNom[1]);
    $ArrayRFC = explode("=", $ArraySubject[5]);
    $RFC      = trim($ArrayRFC[1]);

    echo $NoCert ."<br>";
    echo $RazSoc ."<br>";
    echo $RFC ."<br>";
    
    $Valid_ObtenDatsFIEL = 0;
    
}else{
    
    $Valid_ObtenDatsFIEL = 1;
}    
    

### FIN DEL SCRIPT ###    
        
    
    
    

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
    
    
    
    
    
