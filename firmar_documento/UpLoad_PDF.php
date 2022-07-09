<?php
header('Content-Type: text/html; charset=UTF-8');
    
$DirDes = "archs_pdf/";

$RefAlfa = $_POST["RefAlfa"];

$ArchPDF = $RefAlfa.".pdf";

if (file_exists($DirDes."/".$ArchPDF)) {
    unlink($DirDes."/".$ArchPDF);
}    

$file_tmp  = $_FILES['ArchPDF']['tmp_name'];
$ArchDes = $DirDes."/".$ArchPDF;
move_uploaded_file($file_tmp,$ArchDes);
chmod($ArchDes, 0777);

echo "OK";
    

