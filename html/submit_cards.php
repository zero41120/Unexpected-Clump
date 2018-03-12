<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors', '1');
    require_once('../includes/config.php');

	safe_array($_GET);
	if(empty($_GET['player'])){ bad_request("GET missing player"); }
	if(empty($_GET['equip'])) { bad_request("GET missing equip");  }
	if(empty($_GET['char']))  { bad_request("GET missing char");   }
	if(empty($_GET['status'])){ bad_request("GET missing status"); }
	if(empty($_GET['room']))  { bad_request("GET missing room");   }
	if(empty(User::find_by_id($_GET['player']))) { bad_request("No such user"); }
	if(empty(User::find_by_id($_GET['room'])))   { bad_request("No such room"); }
	$info = new Submitted_info();
	$info->player_id = $_GET['player'];
	$info->equipment_card_id = $_GET['equip'];
	$info->character_card_id = $_GET['char'];
	$info->status_card_id = $_GET['status'];
	$info->room_id = $_GET['room'];
	$info->save();
?>