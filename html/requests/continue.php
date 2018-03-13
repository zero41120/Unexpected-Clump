<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors', '1');
    require_once('../../includes/config.php');
	restricted();

	// Check request integrity
	if(empty($_GET['player'])){
		bad_request("Continue request failed due to missing player number");
	}

	if(empty($_GET['room'])){
		bad_request("Continue request failed due to missing room number");
	}

	safe_array($_GET);

	$player = User::find_by_id($_GET['player']);
	if(empty($player)){
		bad_request("Continue request fail due to invalid player number");
	}

	$room = Room::find_by_id($_GET['room']);
	if(empty($room)){
		bad_request("Continue request fail due to invalid room number");
	}

	// This is judge
	if($room->user_id == $player->id){
		echo '{
			"judge": true,
			"winner": "WINNER"
		}';
	} else {

		if(!empty(Submitted_info::submitted($player->id))){
		 	echo('{"wait": true}');
		} else {
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
		}
	}
	# the cards structure is identical to how is appears in join_room.php
	# WINNER is true if the player won the previous round, otherwise false
	# exactly one player is chosen as the new judge, whether that's based on the winner, at random, or on rotation
	# the new judge gets the following response instead, as no cards are needed:
?>