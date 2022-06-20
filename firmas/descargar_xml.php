<?php

$NomArch = $_GET["NomArch"];
$Senda   = $_GET["Senda"];

header('Content-Type: text/html; charset=UTF-8');
header("Content-Description: File Transfer");
header("Content-Transfer-Encoding: binary");
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=$NomArch");

$archivoADescargar = file_get_contents($Senda.$NomArch);

echo $archivoADescargar;
