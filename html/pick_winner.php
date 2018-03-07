<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors', '1');
    require_once('../includes/config.php');
?>

<?php
	// Check request integrity
	if(empty($_GET['judge'])){
		die("Pick winner request failed due to missing judge number");
	}
	if(empty($_GET['winner'])){
		die("Pick winner request failed due to missing winner number");
	}
?>

<?php

	safe_array($_GET);
	$judge = User::find_by_id($_GET['judge']);
	if(empty($judge)){
		die("Pick winner request failed due to invalid judge number");
	}
	$winner = User::find_by_id($_GET['winner']);
	if(empty($winner)){
		die("Pick winner request failed due to invalid winner number");
	}


	// SWAP judge with winner, make judge become a player, vise versa.
	$room = Room::find_by_host_user_id($judge->id);
	$room->user_id = $winner->id;
	$room->save();

	$room_user = Room::find_by_second_id($winner->id);
	$room_user->user_id = $judge->id;
	$room_user->save();

	Submitted_info::delete_by_room_id($room->id);

	echo("200 (OK)");

	# $judge should be the PLAYERID of the judge, don't allow winner to be submitted otherwise
	# $winner is the PLAYERID of the winner picked by the judge
	# should just return an empty 200 (OK) response
?>
