<?php

namespace App\Libraries;

class Base64FileUpload
{

	function is_base64($s)
	{
		$decoded = base64_decode($s, true);
		if (false === $decoded) return false;
		// Encode the string again
		if (base64_encode($decoded) != $s) return false;
		return true;
	}

	public function check_size($base64string)
	{
		$file_size = 8000000;
		$size = @getimagesize($base64string);

		if ($size['bits'] >= $file_size) {
			print_r(json_encode(array('status' => false, 'message' => 'file size not allowed !')));
			exit;
		}
		return true;
	}

	public function check_dir($path)
	{
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
			return true;
		}
		return true;
	}

	public function check_file_type($base64string, $allowed_file_types = [])
	{
		$mime_type = @mime_content_type($base64string);
		if (count($allowed_file_types) > 0) {
			if (!in_array($mime_type, $allowed_file_types)) {
				return false;
			} else {
				return true;
			}
		} else {
			return true;
		}
	}

	public function upload_file($path, $base64string)
	{
		$base64Complete = $base64string;
		list($type, $base64string) = explode(';', $base64string);
		list(, $extension) = explode('/', $type);
		list(, $base64string) = explode(',', $base64string);

		if ($this->is_base64($base64string) == true) {
			$this->check_dir($path);
			list($type, $base64Complete) = explode(';', $base64Complete);
			list(, $extension) = explode('/', $type);
			list(, $base64Complete) = explode(',', $base64Complete);
			$fileName = uniqid() . '_' . date('Y_m_d') . '.' . $extension;
			$base64Complete = base64_decode($base64Complete);
			file_put_contents($path . $fileName, $base64Complete);
			return array('status' => true, 'message' => 'Subido correctamente', 'file_name' => $fileName, 'file_path' => $path . $fileName);
		} else {
			print_r(json_encode(array('status' => false, 'message' => 'El archivo no es base 64')));
			exit;
		}
	}

	public function upload_image($path, $base64string)
	{
		if ($this->is_base64($base64string) == true) {
			$this->check_dir($path);
			if ($this->check_file_type($base64string, ['image/png', 'image/jpeg', 'image/jpg'])) {
				list($type, $base64string) = explode(';', $base64string);
				list(, $extension) = explode('/', $type);
				list(, $base64string) = explode(',', $base64string);
				$fileName = uniqid() . '_' . date('Y_m_d') . $extension;
				$base64string = base64_decode($base64string);
				file_put_contents($path . $fileName, $base64string);
				return array('status' => true, 'message' => 'Subido correctamente', 'file_name' => $fileName, 'file_path' => $path . $fileName);
			} else {
				print_r(json_encode(array('status' => false, 'message' => 'El archivo no es imagen')));
				exit;
			}
		} else {
			print_r(json_encode(array('status' => false, 'message' => 'El archivo no es base 64')));
			exit;
		}
	}
}
