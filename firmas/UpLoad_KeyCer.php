<?php
header('Content-Type: text/html; charset=UTF-8');
    
$DirDes = "archs_fiel/";

$RefAlfa = $_POST["RefAlfa"];

$ArchKEY = $RefAlfa.".key";
$ArchCER = $RefAlfa.".cer";

if (file_exists($DirDes."/".$ArchKEY)) {
    unlink($DirDes."/".$ArchKEY);
}    

if (file_exists($DirDes."/".$ArchCER)) {
    unlink($DirDes."/".$ArchCER);
}    

$file_tmp  = $_FILES['ArchFIELkey']['tmp_name'];
$ArchDes = $DirDes."/".$ArchKEY;
move_uploaded_file($file_tmp,$ArchDes);
chmod($ArchDes, 0777);

$file_tmp  = $_FILES['ArchFIELcer']['tmp_name'];
$ArchDes = $DirDes."/".$ArchCER;
move_uploaded_file($file_tmp,$ArchDes);
chmod($ArchDes, 0777);

echo "OK";
    

