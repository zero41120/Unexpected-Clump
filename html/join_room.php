<?php
	$room = $_GET['room'];
	$name = $_GET['name'];
	
	# $room is the ROOMID string given in create_room.php
	# $name is a player chosen string, their name that will be visible to the judge
	# I could limit which characters are usable for $name on the front end, but it should be sanitized anyway
	
	echo '{
		"cards": {
			"characters": [
				{
					"id": "CARDID",
					"name": "Card Name",
					"ability": "Put the ability of the card here (empty string if none)",
					"image": "/img/path.whatever"
				},
				{
					"id": "CARDID",
					"name": "Card Name",
					"ability": "Put the ability of the card here (empty string if none)",
					"image": "/img/path.whatever"
				}
			],
			"equipment": [
				{
					"id": "CARDID",
					"name": "Card Name",
					"ability": "Put the ability of the card here (empty string if none)",
					"image": "/img/path.whatever"
				},
				{
					"id": "CARDID",
					"name": "Card Name",
					"ability": "Put the ability of the card here (empty string if none)",
					"image": "/img/path.whatever"
				}
			],
			"statuses": [
				{
					"id": "CARDID",
					"name": "Card Name",
					"ability": "Put the ability of the card here (empty string if none)",
					"image": "/img/path.whatever"
				},
				{
					"id": "CARDID",
					"name": "Card Name",
					"ability": "Put the ability of the card here (empty string if none)",
					"image": "/img/path.whatever"
				}
			]
		},
		"player": "PLAYERID"
	}';
	# PLAYERID is a generated string which uniquely identifies the player, as CARDID should be for each card
	# whitespace can be omitted in the JSON response (except in strings like card names, of course)
	# it is fine to start dealing out cards before all players have joined the room
	# we can decide on how many of each type of card to deal out later, but having some with 4 or more would be useful to test horizontal scrolling
	# ideally, cards never repeat within a room, but that isn't critical at the moment
?>
