<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors', '1');
    require_once('../includes/config.php');
?>

<?php

	safe_array($_GET);
	if(empty($_GET['player'])){ die("GET missing player"); }
	if(empty($_GET['equip'])) { die("GET missing equip");  }
	if(empty($_GET['char']))  { die("GET missing char");   }
	if(empty($_GET['status'])){ die("GET missing status"); }
	if(empty($_GET['room']))  { die("GET missing room");   }
	if(empty(User::find_by_id($_GET['player']))) { die("No such user"); }
	if(empty(User::find_by_id($_GET['room'])))   { die("No such room"); }
	$info = new Submitted_info();
	$info->player_id = $_GET['player'];
	$info->equipment_card_id = $_GET['equip'];
	$info->character_card_id = $_GET['char'];
	$info->status_card_id = $_GET['status'];
	$info->room_id = $_GET['room'];
	$info->save();

	echo("200 (OK)");
	# $player will be the same ROOMID and PLAYERID strings given earlier
	# $char, $equip, and $status will be each card's CARDID, as given earlier
	# if we don't track players across rooms, then each player is in at most one room, but we could add the parameter if necessary
	# don't think this needs to return anything, just an empty 200 (OK) response
?>

