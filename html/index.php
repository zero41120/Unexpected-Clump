<!-- Set environment and debug flag-->
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
    require_once('../includes/config.php');
    $debug_mode     = false; 
    $database_save  = true;
    if($debug_mode) { var_dump($session); }
?>

<html>
	<head>
		<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="scripts/shared.js"></script>
		<link type="text/css" rel="stylesheet" href="css/shared.css">
		<link type="text/css" rel="stylesheet" href="css/card_select.css">
	</head>
	<?php 
		$themes = Theme::find_all();
		echo("<div id=\"theme_list\" hidden>");
		echo(json_encode($themes));
		echo("</div>");
	?>

	<body>
		<div id="content">
			<div class="view current_view" id="home_view">
				<div class="message">Welcome to Unexpected Clump!</div>
				<div class="button" id="create_room_button"><span class="button_label">Create Room</span></div>
				<div class="button" id="join_room_button"><span class="button_label">Join Room</span></div>
				<div class="button" id="rules_button"><span class="button_label">Show Rules</span></div>
				<div id="rules_text" hidden>Put the rules here.</div>
			</div>
			<div class="view" id="create_room_view">
				<div id="host_name_container">
					<span class="input_label">Enter Name:</span>
					<span class="input_text"><input type="text" id="host_name_input"></input></span>
				</div>
				<div id="room_theme_container">
					<span class="input_label">Choose Themes:</span>
					<span id="theme_checkbox_list">
						<span class="input_checkbox">Theme0: <input type="checkbox" data-theme="0" checked></input></span>
						<span class="input_checkbox">Theme1: <input type="checkbox" data-theme="1" checked></input></span>
						<span class="input_checkbox">Theme2: <input type="checkbox" data-theme="2" checked></input></span>
					</span>
				</div>
				<div class="button" id="submit_create_button"><span class="button_label">Create Room</span></div>
			</div>
			<div class="view" id="join_room_view">
				<div id="player_name_container">
					<span class="input_label">Enter Name:</span>
					<span class="input_text"><input type="text" id="player_name_input"></input></span>
				</div>
				<div id="room_number_container">
					<span class="input_label">Enter Room:</span>
					<span class="input_text"><input type="text" id="room_number_input"></input></span>
				</div>
				<div class="button" id="submit_join_button"><span class="button_label">Join Room</span></div>
			</div>
			<div class="view" id="card_select_view">
				<div id="scroll_container"></div>
				<div class="button" id="submit_button"><span class="button_label">Submit</span></div>
				<div class="button" id="clear_button"><span class="button_label">Clear</span></div>
				<script type="text/javascript" src="scripts/card_select.js"></script>
			</div>
			<div class="view" id="judge_wait_view">
				<div class="message">You are judging for: Room <span id="room_label"></span></div>
				<div class="message">Select a winner after all players have chosen their cards.</div>
				<div class="button" id="select_winner_button"><span class="button_label">Select Winner</span></div>
			</div>
			<div class="view" id="select_winner_view">
				<div class="message">Select the winner:</div>
				<div id="player_list"></div>
				<div class="button" id="judge_back_button"><span class="button_label">Back</span></div>
			</div>
			<div class="view" id="continue_view">
				<div class="player_message">
					<div class="message">You have selected:</div>
					<div class="scroll" id="selection_list"></div>
					<div class="message">Press continue after judging has ended to start a new round.</div>
				</div>
				<div class="judge_message">
					<div class="message">Press continue to start a new round.</div>
				</div>
				<div class="button" id="continue_button"><span class="button_label">Continue</span></div>
				<div class="button" id="exit_button"><span class="button_label">Exit Room</span></div>
			</div>
			<div class="view" id="error_view">
				<div class="message" id="error_message">An error has occurred: <span id="error_text"></span>.</div>
				<div class="button" id="return_button"><span class="button_label">Home</span></div>
			</div>
		</div>
	</body>
</html>
