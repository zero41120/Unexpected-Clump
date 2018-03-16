<!-- Set environment and debug flag-->
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
    require_once('../../includes/config.php');
    $debug_mode     = false; 
    $database_save  = true;
    if($debug_mode) { var_dump($session); }
?>

<html>
<head>
	<title>Test join</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body onload="test()">
	See console, this page should run create_room.php for 100 times, checking the json encode.
</body>

<script type="text/javascript">

	function request(options){
		return new Promise((res,rej) => {
			if(typeof options === 'string') options = {url: options};
			if(!options.url) return rej('no url given for request');
			if(!options.complete) options.complete = (response,status) => {
				if(response.status === 200) res(response.responseText);
				else rej(response.responseText);
			};
			$.ajax(options);
		});
	};

	function create_room(){
	var url = `../requests/create_room.php?name=test_host&themeList=1,2,3,4`;
		console.log(url);
		request(url).then(json => {
			console.log("response:" + json);
			var response = JSON.parse(json);
		});
	}
	function test(){
		for (var i = 0; i < 100; i++) {
			create_room();
		}
	};
</script>
</html>