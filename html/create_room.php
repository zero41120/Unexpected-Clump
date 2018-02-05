<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors', '1');
    require_once('../includes/config.php');
?>

<?php
	// TODO Get information about theme id's


	// Create new user, aka judge
	$user = new User();
	$name = empty($_GET['playerName'])? "Host" : safe_input($_GET['playerName']);
	$user->name = $name;
	$user->save(); // Auto generate a user_id

	// Create new room
	$room = new Room();
	$room->user_id = $user->id;
	$room->save(); // Auto generate a room id

	// Update room information
	$room->player_id = $user->id;
	$room->is_host = 1;
	$room->save(); 
	$info = '{';
	$info .= '"room_id": '   . $room->id  . ',';
	$info .= '"player_id": ' . $room->player_id . '';
	$info .= '}';
	echo($info);
	# ROOMID is a generated string value that uniquely identifies the room created
	# PLAYERID is a generated string value that uniquely identifies the player who created the room
	# this player will become the first judge, unless we want to change that later
	# ROOMID should be relatively short, since the players wishing to join will have to type it out
?>
