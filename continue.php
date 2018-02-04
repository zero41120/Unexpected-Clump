<?php
	$player = $_GET['player'];
	
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
		"judge": false,
		"winner": WINNER
	}';
	# the cards structure is identical to how is appears in join_room.php
	# WINNER is true if the player won the previous round, otherwise false
	# exactly one player is chosen as the new judge, whether that's based on the winner, at random, or on rotation
	# the new judge gets the following response instead, as no cards are needed:
	/*
	echo '{
		"judge": true,
		"winner": WINNER
	}';
	*/
?>
