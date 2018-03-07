<!-- Set environment and debug flag-->
<?php
	//error_reporting(E_ALL);
	ini_set('display_errors', '1');
    require_once('../includes/config.php');
    $debug_mode     = false; 
    $database_save  = true;
    if($debug_mode) { var_dump($session); }
?>

<html>
	<head>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="javascript/shared.js"></script>
		<link type="text/css" rel="stylesheet" href="css/shared.css">
		<link type="text/css" rel="stylesheet" href="css/card_select.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<script type="text/javascript" src="javascript/bootstrap.js"></script>
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap2-toggle.min.css" rel="stylesheet">
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap2-toggle.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
		p.a {
		margin: 35px 90px 90px 90px;
			}

		  p.b {
			font-family: "Lucida Console", Monaco, monospace;
			margin-right: 80px;
			margin-left: 80px;
			margin-top:50px;
			}	
		  p.bi {
			font-family: "Lucida Console", Monaco, monospace;
			margin-right: 80px;
			margin-left: 80px;
			margin-top:10px;
			}
		</style>
		<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="scripts/shared.js"></script>
    <script type="text/javascript" src="scripts/card_select.js"></script>

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
		
		
			<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
				<a class="navbar-brand text-white"  style= "cursor:pointer" id="return_button" >Unexpected Clump</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar3">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="navbar-collapse collapse" id="navbar3">
				<ul class="navbar-nav">
				<li class="nav-item active">
                <a class="nav-link" style= "cursor:pointer" id="create_room_button" >Create <span class="sr-only">Home</span></a>
				</li>
				<li class="nav-item">
                <a class="nav-link" style= "cursor:pointer" id="join_room_button">Join</a>
				</li>
				<li class="nav-item">
                <a class="nav-link" style= "cursor:pointer" id="rules_button">Rules</a>
				</li>
				</ul>
				</div>
			</nav>
		
		
		
			<div class="view current_view" id="home_view">
			<p class="b"> 
			Welcome to Unexpected Clump!<br>

			A game created for CMPS 183. 
			</p>

			</div>
			
			
			
			
			
			<div class="view" id="create_room_view">
			
				
				
				
				<div id="host_name_container">
				<p class="b"> 
					<span class="input_label">Enter Name:</span>
					<span class="input_text"><input type="text" id="host_name_input"></input></span>
					</p> 
				</div>
				<div id="room_theme_container">
				<p class="bi">
					
					<label class="checkbox-inline">
					<input checked data-toggle="toggle" type="checkbox" data-theme="0" checked> </input>  First  
					</label>
					<label class="checkbox-inline">
					<input checked data-toggle="toggle" type="checkbox" data-theme="1" checked> </input>  Second  
					</label>
					<label class="checkbox-inline">
					<input checked data-toggle="toggle" type="checkbox" data-theme="2" checked> </input>  Third  
					</label>

				</p>	
				</div>
				<p class="bi">
				<div class="button" id="submit_create_button">
				

				</p>
				</div>
				
			
			</div>
			
			
			
			
			
			<div class="view" id="join_room_view">
				
			
	
				
				
				<div id="player_name_container">
				<p class="b"> 
					<span class="input_label">Enter Name:</span>
					<span class="input_text"><input type="text" id="player_name_input"></input></span>
				</p> 
				</div>
				<div id="room_number_container">
				<p class="bi"> 
					<span class="input_label">Enter Room:</span>
					<span class="input_text"><input type="text" id="room_number_input"></input></span>
				</p> 
				</div>
				
				
				<div class="button" id="submit_join_button">
				<p class="bi">
				<span class="button_label">Join Room</span>
				</p>
				</div>
				 
			</div>
			
			<div class="view" id="rules_view">
				
						<div class="message"><p class="a">Rules:</p></div>
				
			</div>
			
			


			<div class="view" id="card_select_view">
				<div id="scroll_container"></div>
				<div class="button" id="submit_button"><span class="button_label">Submit</span></div>
				<div class="button" id="clear_button"><span class="button_label">Clear</span></div>

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
				<div class="button" id="return_button"><span class="button_label">Home</span></div>

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
