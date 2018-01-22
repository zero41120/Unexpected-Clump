<?php
// For remote development only
include_once("authentication.php");
defined ( 'WEB_SERVER' ) ? null : define ( "WEB_SERVER", "localhost" );
defined ( 'WEB_USER' ) ? null : define ( "WEB_USER", "game" );
defined ( 'WEB_PASS' ) ? null : define ( "WEB_PASS", "password" );
defined ( 'WEB_NAME' ) ? null : define ( "WEB_NAME", "clump" );


class MySQLDatabase {
	/**
	 * This are the common functions for any database.
	 * If we ever change the database managemenet system,
	 * then the methods in this class must be re-implement.
	 */
	private $connection;
	function __construct($server, $user, $pass, $db_name, $db_port = "") {
		try {
			$this->open_connection ($server, $user, $pass, $db_name, $db_port);
		} catch (Exception $e) {
			header ( "Location: " . "maintain.php" );
			//die ( "Database connection failed: " . mysqli_connect_error () . "(" . mysqli_connect_errno () . ")" );
			exit ();
		}
		
	}

	public function open_connection($server, $user, $pass, $db_name, $db_port) {
		if(empty($db_port)) {
			$this->connection = mysqli_connect($server, $user, $pass, $db_name);
		} else {
			$this->connection = mysqli_connect($server, $user, $pass, $db_name, $db_port);
		}
		if (mysqli_connect_errno ()) {
			throw new Exception("error connecting game server");
			
			// die ( "Database connection failed: " . 
			// 	  mysqli_connect_error () . 
			// 	  "(" . mysqli_connect_errno () . ")" 
			// 	);
		}
	}
	public function close_connection() {
		if (isset ( $this->connection )) {
			mysqli_close ( $this->connection );
			unset ( $this->connection );
		}
	}
	public function query($sql) {
		$result = mysqli_query ( $this->connection, $sql );
		$this->confirm_query ( $result, $sql );
		return $result;
	}
	private function confirm_query($result, $sql) {
		if (!$result) {
			//mysqli_rollback($this);
			//die("Failed sql: " . $sql . '(' . $this->connection->error .')' ); // TODO
  			header ( "Location: " . "maintain.php" );
					
		}
		return true;
	}
	public function escape_value($string) {
		$this->connection;
		$escaped_string = mysqli_real_escape_string ( $this->connection, $string );
		return $escaped_string;
	}
	public function fetch_array($result_set) {
		return mysqli_fetch_array ( $result_set );
	}
	public function num_rows($result_set) {
		return mysqli_num_rows ( $result_set );
	}
	public function insert_id() {
		// get the last id inserted over the current db connection
		// Useful for db subclass to save data and set its id.
		return mysqli_insert_id ( $this->connection );
	}
	public function affected_rows() {
		return mysqli_affected_rows ( $this->connection );
	}
	public function convert_php_time_to_sql_time($phptime) {
		return date ( "Y-m-d H:i:s", $phptime );
	}
}


$main_db = new MySQLDatabase(WEB_SERVER, WEB_USER, WEB_PASS, WEB_NAME);
// $game_db = new MySQLDatabase(GAME_SERVER, GAME_USER, GAME_PASS, GAME_NAME, GAME_PORT); if needed

?>
