<?php
	$player = $_GET['player'];
	$char = $_GET['char'];
	$equip = $_GET['equip'];
	$status = $_GET['status'];
	
	# $player will be the same ROOMID and PLAYERID strings given earlier
	# $char, $equip, and $status will be each card's CARDID, as given earlier
	# if we don't track players across rooms, then each player is in at most one room, but we could add the parameter if necessary
	# don't think this needs to return anything, just an empty 200 (OK) response
?>
