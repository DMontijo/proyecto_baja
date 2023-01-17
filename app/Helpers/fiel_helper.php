<?php
function validarFiel($agentId)
{
	date_default_timezone_set('America/Tijuana');
	$user_id = $agentId;
	$directory = FCPATH . 'uploads/FIEL/' . $user_id;
	$file_txt  = $user_id . "_data.txt";

	$sslcert = file_get_contents($directory . '/' . $file_txt);
	$sslcert = array(openssl_x509_parse($sslcert, TRUE));

	foreach ($sslcert as $name => $arrays) {
		foreach ($arrays as $title => $value) {
			if (is_array($value)) {
				foreach ($value as $subtitle => $subvalue) {
					if ($subtitle == "keyUsage") {
						$ArrayUsos = explode(",", $subvalue);
					}
				}
			}
		}
	}

	for ($i = 0; $i < count($ArrayUsos); $i++) {
		if (trim($ArrayUsos[$i]) == "Digital Signature") {
			$ResBus1 = 1;
		}
		if (trim($ArrayUsos[$i]) == "Data Encipherment") {
			$ResBus2 = 1;
		}
		if (trim($ArrayUsos[$i]) == "Key Agreement") {
			$ResBus3 = 1;
		}
	}

	$FechaActual = date("Y/m/d");

	$datosFIEL = file_get_contents($directory . '/' . $file_txt);

	$CadABusc1 = "Not Before:";
	$pos1 = strpos($datosFIEL, $CadABusc1);

	$CadABusc2 = "Not After :";
	$pos2 = strpos($datosFIEL, $CadABusc2);

	$Fecha1 = substr($datosFIEL, $pos1 + 12, 24);
	$Fecha2 = substr($datosFIEL, $pos2 + 12, 24);

	$PrimerFecha  = date("Y/m/d", strtotime($Fecha1));
	$SegundaFecha = date("Y/m/d", strtotime($Fecha2));


	//VERIFICAR SI ES UNA FIEL  ******************************************************
	if ($ResBus1 == 1 && $ResBus2 == 1 && $ResBus3 == 1) {
		# VERIFICAR VIGENCIA DE LA FIEL  ******************************************************
		if ($FechaActual >= $PrimerFecha && $FechaActual <= $SegundaFecha) {
			$now_timestamp = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
			$vencimiento_timestamp = mktime(0, 0, 0, date("m", strtotime($Fecha2)), date("d", strtotime($Fecha2)), date("Y", strtotime($Fecha2)));
			$diferencia = floor(abs(($vencimiento_timestamp - $now_timestamp) / (60 * 60 * 24)));
			return ['valida' => true, 'fechainicio' => date("d-m-Y", strtotime($Fecha1)), 'fechafinal' => date("d-m-Y", strtotime($Fecha2)), 'restante' => $diferencia];
		} else {
			return ['valida' => false];
		}
	} else {
		return ['valida' => false];
	}
}