<?php

$DescripDoc = "Constancia de estudios con calificaciones.";


echo $DescripDoc . "<br><br>";

echo CrearNomArch($DescripDoc);

//echo LimpiarCadena($DescripDoc);


function CrearNomArch($str){
    
//    $str = LimpiarCadena($str);
    
    $textoLimpio = preg_replace('([^A-Za-z0-9 áéíóúÁÉÍÓÚ])', '', substr($str,0,300));
    
//    $textoLimpio = strtr($textoLimpio, "áéíóúÁÉÍÓÚ", "aeiouAEIOU");
    
    $Cadena = mb_strtolower($textoLimpio, 'UTF-8');
    
    $ArrayCad = explode(" ", $Cadena);
    
    $NomArch = "";
    
    foreach ($ArrayCad as $data){
        
        $NomArch .= ucfirst($data);
    }
    
    return $NomArch;
}


function LimpiarCadena($cadena){
    
    $textoLimpio = preg_replace('([^A-Za-z0-9  áéíóúÁÉÍÓÚ])', '', substr($cadena,0,300));
    
//    $originales  = "áéíóúÁÉÍÓÚ";
//    $modificadas = "aeiouAEIOU";
//    
//    $textoLimpio = strtr($textoLimpio, $originales, $modificadas);
    
    return $textoLimpio;
}
