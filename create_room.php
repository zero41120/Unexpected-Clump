<?php
	$theme = $_GET['theme'];
	# $theme will be the id of the theme that the player creating the room selected
	
	echo '{
		"room": ROOMID,
		"player": PLAYERID
	}';
	# ROOMID is a generated string value that uniquely identifies the room created
	# PLAYERID is a generated string value that uniquely identifies the player who created the room
	# this player will become the first judge, unless we want to change that later
	# ROOMID should be relatively short, since the players wishing to join will have to type it out
?>
