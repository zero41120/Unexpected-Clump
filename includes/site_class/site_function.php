<?php

function get_json($name, $array){
	$str = '"' . $name . '":[';
	foreach ($array as $value) {
		$val = json_encode($value);
		if(empty($val)){
			// echo(json_last_error() . " json encode error\n");
			// var_dump($value);
		} else {
			$str .= $val . ',';
		}
	}
	$str = rtrim($str, ',');
	$str .= ']';
	return $str;
}

function bad_request($message){
	http_response_code(400);
	die($message);
}

function restricted(){
	// https://stackoverflow.com/questions/15436948

	// Protect from non ajax access
	define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
	if(!IS_AJAX) { bad_request('Restricted access to ajax request only.'); }
	$pos = strpos($_SERVER['HTTP_REFERER'],getenv('HTTP_HOST'));
	if($pos===false){ bad_request('Restricted access'); }
}

?>