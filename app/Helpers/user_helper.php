<?php

function hashPassword($password)
{
	return password_hash($password, PASSWORD_DEFAULT);
}

function validatePassword($password, $hash)
{
	return password_verify($password, $hash);
}

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
