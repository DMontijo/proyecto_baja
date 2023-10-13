<?php

/**Funcion para encriptar las contraseñas */
function hashPassword($password)
{
	return password_hash($password, PASSWORD_DEFAULT);
}

/**Funcion para validar la contraseña con la contraseña encriptada */
function validatePassword($password, $hash)
{
	return password_verify($password, $hash);
}

/**Funcion para saber el tipo de expediente de acuerdo a su  ID*/
function tipoExpediente($num)
{
	$num = gettype($num) == 'string' ? $num : (string)$num;

	switch ($num) {
		case '1':
			return 'NUC';
			break;
		case '4':
			return 'NAC';
			break;
		case '5':
			return 'RAC';
			break;
		case '6':
			return 'EXH';
			break;
		case '7':
			return 'NAV';
			break;
		case '8':
			return 'NCE';
			break;
		case '9':
			return 'NUI';
			break;
		default:
			return '';
			break;
	}
}
 
function validateEmail($dataEmail){
	$ch = curl_init();
	$bodyData = array('email' => $dataEmail);
	
	curl_setopt($ch, CURLOPT_URL, 'https://api.mailersend.com/v1/email-verification/verify');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($bodyData));
	$headers = array(
		'Content-Type: application/json',
		'Access-Control-Allow-Origin: *',
		'Access-Control-Allow-Credentials: true',
		'Access-Control-Allow-Headers: Content-Type',
		'Authorization: Bearer '.EMAIL_TOKEN,
	);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);

	curl_close($ch);
	// var_dump($data);
	// var_dump($result);exit;
	// return $result;
	$dataResult = json_decode($result);
	if(isset($dataResult->status) && $dataResult->status == "valid"){
		return true;
	}else{
		return false;
	}
	///return json_decode($result);
}