<?php
	$judge = $_GET['judge'];
	
	echo '[
		{
			"player": "PLAYERID",
			"name": "Chosen Name",
		},
		{
			"player": "PLAYERID",
			"name": "Chosen Name",
		},
		{
			"player": "PLAYERID",
			"name": "Chosen Name",
		}
	]';
	# $judge should be the PLAYERID of the judge, can return an empty array or some 400's code otherwise
	# depending on how we want the screen to look, we may or may not want to include player's card choices as well
?>
