<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors', '1');
    require_once('../../includes/config.php');
	restricted();

	// Check request integrity
	if(empty($_GET['judge'])){
		bad_request("Pick winner request failed due to missing judge number");
	}
	if(empty($_GET['winner'])){
		bad_request("Pick winner request failed due to missing winner number");
	}


	safe_array($_GET);
	$judge = User::find_by_id($_GET['judge']);
	if(empty($judge)){
		bad_request("Pick winner request failed due to invalid judge number");
	}
	$winner = User::find_by_id($_GET['winner']);
	if(empty($winner)){
		bad_request("Pick winner request failed due to invalid winner number");
	}


	// SWAP judge with winner, make judge become a player, vise versa.
	$room = Room::find_by_host_user_id($judge->id);
	$room->user_id = $winner->id;
	$room->save();


	Submitted_info::delete_by_room_id($room->id);

	$room_user = Room_user::find_by_second_id($winner->id);
	$room_user = $room_user[0];
	var_dump($room_user);

	$room_user->user_id = $judge->id;
	$room_user->save();

?>