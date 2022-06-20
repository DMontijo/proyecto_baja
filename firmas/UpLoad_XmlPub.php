<?php
header('Content-Type: text/html; charset=UTF-8');
    
$DirDes = "archs_valid/";

$RefAlfa = $_POST["RefAlfa"];

$ArchXML = $RefAlfa.".xml";
$ArchPUB = $RefAlfa.".pub";

$file_tmp  = $_FILES['ArchXML']['tmp_name'];
$ArchDes = $DirDes."/".$ArchXML;
move_uploaded_file($file_tmp,$ArchDes);
chmod($ArchDes, 0777);


$file_tmp  = $_FILES['ArchPUB']['tmp_name'];
$ArchDes = $DirDes."/".$ArchPUB;
move_uploaded_file($file_tmp,$ArchDes);
chmod($ArchDes, 0777);

echo "OK";
    

