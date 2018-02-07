<?php

function get_json($name, $array){
	$str = '"' . $name . '":[';
	foreach ($array as $value) {
		$str .= json_encode($value);
		$str .= ',';
	}
	$str = rtrim($str, ',');
	$str .= ']';
	return $str;
}

?>