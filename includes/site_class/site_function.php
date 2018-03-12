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

?>