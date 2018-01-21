<?php 

$url = array(
	'home'					=> 'index.php'
);

$text_english = array(
	'home_title'			=> "Unexpected Clump",
	'confirm'				=> "confirm",
	'footer_info'			=> "Unexpected-Clump 2018"
);

function echo_url($key){
	global $url;
	echo($url[$key]);
}

function echo_text($key, $lang = "en-US"){
	if($lang == "en-US"){
		global $text_english;
		echo($text_english[$key]);	
	}
}

function get_text($key, $lang = "en-US"){
	if($lang == "en-US"){
		global $text_english;
		return $text_english[$key];	
	}
}

?>
