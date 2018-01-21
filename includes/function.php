<?php
function br2nl( $input ) {
	return preg_replace('/<br\s?\/?>/ius', "\n", 
		   str_replace("\n","",
		   str_replace("\r","", htmlspecialchars_decode($input))));
}
function is_ie() {
	preg_match ( '/MSIE (.*?);/', $_SERVER ['HTTP_USER_AGENT'], $matches );
	if (count ( $matches ) < 2) {
		preg_match ( '/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER ['HTTP_USER_AGENT'], $matches );
	}
	if (count ( $matches ) > 1) {
		// Then we're using IE
		$version = $matches [1];
		
		switch (true) {
			
			case ($version <= 11) :
				return true;
				break;
			
			default :
				return false;
				break;
		}
	}
}

function include_layout_template($template_name = "") {
	include (LIB_PATH . DS . 'layouts' . DS . $template_name);
}

function echo_html_header($title, $css = "default.css"){
	echo('<html>');
	echo('<head>');
	echo('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">');
	echo('<title>'. $title. '</title>');
	echo('<link rel="stylesheet" type="text/css" href="');
	echo('css/' . $css);
	echo('" media="all">');
	echo('</head>');
}

function redirect_to($new_location) {
	header ( "Location: " . $new_location );
	exit ();
}

function safe_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function safe_array($array){
	global $db_connect;
	foreach ( $array as $key => $value ) {
		if (!empty ( $value )) {
			$array[$key] = $db_connect->escape_value(safe_input($value));
		}
	}
}

?>