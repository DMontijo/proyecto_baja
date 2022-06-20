<?php
header('Content-Type: text/html; charset=UTF-8');

if (function_exists('exec')) {
    echo '<span style="color: #129031;">La funcion exec() si está disponible.</span><br><br>';
} else {
    echo '<span style="color: #A70202;">La funcion exec() no está disponible.</span><br><br>';
}

$SendaFIEL_test  = "fiel_test/"; // Directorio en donde se encuentra la FIEL para hacer pruebas.
$FIEL_NomArchKEY = "rutr7201209h5.key"; // Nombre del archivo .key de la FIEL.
$FIEL_NomArchCER = "rutr7201209h5.cer"; // Nombre del archivo .cer de la FIEL.
$FIEL_Password   = "n93kZ84h";  // Contraseña de la FIEL.

$PEM_NomArchKEY = "rutr7201209h5.key.pem"; // Nombre del archivo .key.pem, este archivo se creara después de ejecutar este script. 

//==============================================================================


echo 'Nombre del archivo .key:&nbsp;';
echo $SendaFIEL_test.$FIEL_NomArchKEY;
echo '<br><br>';

echo 'Nombre del archivo .cer:&nbsp;';
echo $SendaFIEL_test.$FIEL_NomArchCER;
echo '<br><br>';


if (file_exists($SendaFIEL_test.$FIEL_NomArchKEY)) {
    echo "El fichero $FIEL_NomArchKEY ==> SI existe";
} else {
    echo "El fichero $FIEL_NomArchKEY ==> NO existe";
}
echo "<br><br>";

if (file_exists($SendaFIEL_test.$FIEL_NomArchCER)) {
    echo "El fichero $FIEL_NomArchCER ==> SI existe";
} else {
    echo "El fichero $FIEL_NomArchCER ==> NO existe";
}
echo "<br><br>";


###  A continuación con la función exec() de PHP se ejecutan los comandos de OppenSSL, analizar con detalle. ##############

    //==========================================================================
    # Obtener el archivo .key.pem del archivo .key 
     
    $Comando_key_pem = "pkcs8 -inform DER -in ".$SendaFIEL_test.$FIEL_NomArchKEY." -passin pass:$FIEL_Password -out ".$SendaFIEL_test.$PEM_NomArchKEY;
    
    echo 'Comando ejecutado: <span style="color: #0404B4;">'.$Comando_key_pem.'</span>';
    echo "<br><br>";
    
    exec('openssl '.$Comando_key_pem, $arr, $status);
    
    echo "Status de ejecución de comando OpenSSL: ".$status;
    echo "<br><br>";
   
  
    if ($status==0){

        # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
        
        chmod($SendaFIEL_test.$PEM_NomArchKEY, 0777);     
         
        echo '<span style="color: #129031; font-size: 14pt;">Si se pudieron ejecutar los comandos OpenSSL.</span>';
        echo "<br><br>";
        echo 'Archivo .KEY correctamente procesado, busque el archivo resultante en la carpeta: archs_pem/  <br>';
    }else{
        
        echo '<span style="color: #A70202; font-size: 14pt;">Error, no se pudieron ejecutar los comandos OpenSSL.</span>';
    }



    
    