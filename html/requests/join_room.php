<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
    require_once('../../includes/config.php');
	restricted();

	// Check request integrity
	if(empty($_GET['room'])){
		bad_request("Join room request failed due to missing room number");
	}
	if(!is_numeric($_GET['room'])){
		bad_request("Join room failed because input is not a number.");
	}

	// Create a new uesr # TODO make sure that it's no longer than 128 char
	$player = new User();
	$player->name = empty($_GET['name'])? "Player" : safe_input($_GET['name']);
	$player->save();

	// Select the room # TODO make sure the room exists.
	$room = Room::find_by_id(safe_input($_GET['room']));
	if(empty($room)){
		bad_request("Join room request failed because room " . safe_input($_GET['room']) . " does not exist.");
	}
	$judge = User::find_by_id($room->user_id);

	// Save this player room-user information
	$room_user = new Room_user();
	$room_user->room_id = $room->id;
	$room_user->user_id = $player->id;
	$room_user->save();

	// Give random cards
	$room_themes = Room_theme::find_by_first_id($room->id);
	$theme_cmma_sep = "";
	if(!empty($room_theme)){
		foreach ($room_themes as $room_theme) {
			$theme_cmma_sep .= $room_theme->theme_id . ",";
		}
		$theme_cmma_sep = rtrim($theme_cmma_sep, ",");
	}

	$c_cards = Character::get_random_by_theme_comma_sep_list($theme_cmma_sep, 3);
	$e_cards = Equipment::get_random_by_theme_comma_sep_list($theme_cmma_sep, 3);
	$s_cards = Status::get_random_by_theme_comma_sep_list($theme_cmma_sep, 3);


	$json_str = '{';
	$json_str .= '"cards":{';
	$json_str .= get_json("characters", $c_cards);
	$json_str .= ',';
	$json_str .= get_json("equipment", $e_cards);
	$json_str .= ',';
	$json_str .= get_json("status", $s_cards);
	$json_str .= '},';
	$json_str .= '"player":' . '"' . $player->id . '"}';
	echo($json_str);
?>