<?php
// clone (new CI_Controller());
function getToken($length){
	$token = "";
	$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
	$codeAlphabet.= "0123456789";
	$max = strlen($codeAlphabet); // edited

	for ($i=0; $i < $length; $i++) {
		$token .= $codeAlphabet[random_int(0, $max-1)];
	}

	return strtoupper($token);
}



function show_array($data, $exit = true)
{

	echo '<pre>';
	print_r($data);
	echo '</pre>';
	if ($exit) {
		exit;
	}
}

function IdentificadorEJson($string = true)
{
	json_decode($string);
	if (json_last_error() === JSON_ERROR_SYNTAX) {
		return false;
	}
	return true;
}

function IdentificadorNumeros($str)
{
	preg_match_all('/\d+/', $str, $matches);
	return $matches[0];
}

function IdentificadorEemail($email)
{
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		return true;
	}
	return false;
}

function ValidaCPF($cpf)
{
	// Verifica se um número foi informado
	if (empty($cpf)) {
		return false;
	}

	// Extrai somente os números
	$cpf = preg_replace( '/[^0-9]/is', '', $cpf );

	// Verifica se foi informado todos os digitos corretamente
	if (strlen($cpf) != 11) {
		return false;
	}
	// Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
	if (preg_match('/(\d)\1{10}/', $cpf)) {
		return false;
	}
	// Faz o calculo para validar o CPF
	for ($t = 9; $t < 11; $t++) {
		for ($d = 0, $c = 0; $c < $t; $c++) {
			$d += $cpf{$c} * (($t + 1) - $c);
		}
		$d = ((10 * $d) % 11) % 10;
		if ($cpf{$c} != $d) {
			return false;
		}
	}
	return true;

}

function IdentificadorValorEmArray($valor, array $array, $coluna = null)
{
	if (!$coluna) {
		$key = array_search($valor, $array);
	} else {
		$key = array_search($valor, array_column($array, $coluna));
	}
	return isset($array[$key]) ? $array[$key] : false;
}

function IdentificarIdDoVideoDoYoutube($url)
{
	if (($pos = strpos($url, '?v=')) !== FALSE) {
		return substr($url, ($pos + 3), 11);
	}
	return false;
}

function convertStdToArray($std)
{
	$className = '';
	$stdArray = $std;
	if (is_object($std)) {
		$className = get_class($std);
		$stdArray = (array)$std;
	}
	foreach ($stdArray as $key => $valor) {
		$newKey = trim(str_replace($className, '', $key));
		$stdArray[$newKey] = $valor;
		if (is_object($valor) || is_array($valor)) {
			$newValue = convertStdToArray($valor);
			$stdArray[$newKey] = $newValue;
		}
		if ($newKey != $key) {
			unset($stdArray[$key]);
		}
	}
	return $stdArray;
}


function urlTitle($string = NULL)
{
	$string = strip_tags($string);
	$procurar = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í',
		'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á',
		'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô',
		'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', '}', ']', '°', '+', '(', ')', '*', '#', '@', '!', '#', '$', '%', '¨', ':', '’', '‘', ',', '.', ':', 'º', '/', '|', '?');
	$substituir = array('a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i',
		'i', 'i', 'd', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 's', 'a', 'a',
		'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o',
		'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', '', '', '', '', '', '', '', '', '', '', ' ', ' ', ' ', ' ', '', '', '', ' ', '', '', '', '-', '', '');
	$replace = str_replace($procurar, $substituir, $string);
	$replace = str_replace(' ', '-', $replace);
	$replace = str_replace(array('-----', '----', '---', '--'), '-', $replace);
	return strtolower($replace);
}

/**
 * @param $valor
 * @return string
 */
function criptografar($valor)
{
	$valor .= md5(sha1('classcar'));
	$s = strlen($valor) + 1;
	$nw = "";
	$n = 7;
	$nindex = 0;
	for ($x = 1; $x < $s; $x++) {
		$m = $x * $n;
		if ($m > $s) {
			$nindex = $m % $s;
		} else if ($m < $s) {
			$nindex = $m;
		}
		if ($m % $s == 0) {
			$nindex = $x;
		}
		$nw = $nw . $valor[$nindex - 1];
	}
	return $nw;
}

/**
 * @param $valor
 * @return bool|string
 */
function decriptografar($valor)
{
	$s = strlen($valor) + 1;
	$nw = "";
	$n = 7;
	for ($y = 1; $y < $s; $y++) {
		$m = $y * $n;
		if ($m % $s == 1) {
			$n = $y;
			break;
		}
	}
	$nindex = 0;
	for ($x = 1; $x < $s; $x++) {
		$m = $x * $n;
		if ($m > $s) {
			$nindex = $m % $s;
		} else if ($m < $s) {
			$nindex = $m;
		}
		if ($m % $s == 0) {
			$nindex = $x;
		}
		$nw = $nw . $valor[$nindex - 1];
	}
	$t = strlen($nw) - strlen(md5(sha1('classcar')));
	return substr($nw, 0, $t);
}

function responseJson($json, $httpCode = 200)
{
	$content = json_encode($json, JSON_PRETTY_PRINT);
	header('content-type: application/json; charset: utf-8');
	http_response_code($httpCode);
	ob_start((true ? 'ob_gzhandler' : null));
	echo $content;
	ob_end_flush();
	$content = null;
	exit();
}

function logGeral($msg = '')
{
	$fileName = 'log-classcar.txt';
	file_put_contents($fileName, 'date: '.date('Y-m-d H:i:s') . "\n" . $msg."\n".client_ip()."\n", LOCK_EX | FILE_APPEND);
	return $msg;
}

function client_ip()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip == '::1' ? '186.214.150.60' : $ip;
}

function soNumeros($c){
	return preg_replace('/\D/', '', $c);
}

function isMobile() {
	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

