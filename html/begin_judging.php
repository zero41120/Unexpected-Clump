<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors', '1');
    require_once('../includes/config.php');
?>

<?php
	safe_array($_GET);
	if(empty($_GET['judge'])) { die("Missing judge"); }
	$room = Room::find_by_host_user_id($_GET['judge']);
	if(empty($room)) { die("Given player id is not a judge"); }

	$submitted_cards = Submitted_info::find_by_room_id($room->id);

	$json_str = '[';
	foreach ($submitted_cards as $card) {
		$player = User::find_by_id($card->player_id);
		$cha = Character::find_by_id($card->character_card_id);
		$equ = Equipment::find_by_id($card->equipment_card_id);
		$sta = Status::find_by_id($card->status_card_id);

		$json_str .= "{";
		$json_str .= '"player":"'. $player->id . '",';
		$json_str .= '"name":"'. $player->name . '",';
		$json_str .= get_json("character_card", $cha);
		$json_str .= ",";
		$json_str .= get_json("equipment_card", $equ);
		$json_str .= ",";
		$json_str .= get_json("status_card", $sta);
		$json_str .= "},";
	}
	$json_str = rtrim($json_str, ",");
	$json_str .= ']';
	echo($json_str);

	# $judge should be the PLAYERID of the judge, can return an empty array or some 400's code otherwise
	# depending on how we want the screen to look, we may or may not want to include player's card choices as well
?>


