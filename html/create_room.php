<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors', '1');
    require_once('../includes/config.php');
?>


<?php
	// Create new user, aka judge
	$user = new User();
	$name = empty($_GET['name'])? "Host" : safe_input($_GET['name']);
	$user->name = $name;
	$user->save(); // Auto generate a user_id

	// Create a new room
	$room = new Room();
	$room->user_id = $user->id;
	$room->save(); // Auto generate a room id

	// Update room information
	$room->player_id = $user->id;
	$room->save();
	
	// Update theme information
	if(!empty( $_GET['themeList'])){
		$matched = preg_match("/^([0-9]+,)*[0-9]/", $_GET['themeList']);
		if($matched){
			$themes = Theme::find_by_id_comma_sep_list($_GET['themeList']);
			if(!empty($themes)){
				foreach ($themes as $theme) {
					$room_theme = new Room_theme();
					$room_theme->room_id = $room->id;
					$room_theme->theme_id = $theme->id;
					$room_theme->save();
				}
			}
		}
	}

	$info = '{';
	$info .= '"room": '   . $room->id  . ',';
	$info .= '"player": ' . $room->player_id . '';
	$info .= '}';
	echo($info);
?>
