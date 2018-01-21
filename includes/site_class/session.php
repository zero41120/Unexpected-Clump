<?php

class Session {

	private $online = false;
	public $user_id;
	public $message = array();
	public $errors  = array();

	/**
	 * This is the constructor of the session class.
	 * It starts the php session if not active.
	 * Everytime this class is constructed,
	 * it checks the information about the user
	 * login, messages between pages, and error output. 
	 */
	function __construct() {
		if (session_status () != PHP_SESSION_ACTIVE) {
			session_start ();
		}
		$this->check_login ();
		$this->check_message ();
		$this->check_error ();
	}

	/**
	 * This method checks if session contains user_id.
	 * If it has, then user has logged in.
	 */
	private function check_login() {
		if (isset ( $_SESSION ['user_id'] )) {
			$this->user_id = $_SESSION ['user_id'];
			$this->online = true;
		} else {
			unset ( $this->user_id );
			$this->online = false;
		}
	}

	/**
	 * This method checks if session contains message.
	 * If it has, then assgin in this class then unset session.
	 */
	private function check_message() {
		if (isset ( $_SESSION ["message"] )) {
			$this->message = $_SESSION ["message"];
			unset ( $_SESSION ["message"] );
		} else {
			$this->message = "";
		}
	}

	/**
	 * This method checks if session contains error.
	 * If it has, then assgin in this class then unset session.
	 */
	private function check_error() {
		if (isset ( $_SESSION ["error"] )) {
			$this->errors = $_SESSION ["error"];
			unset ( $_SESSION ["error"] );
		} else {
			$this->errors = array ();
		}
	}

	/**
	 * This method takes a User object and retrieves its id and
	 * check if it has a GM character.
	 */
	public function login($user) {
		if ($user) {
			$this->user_id = $_SESSION ['user_id'] = $user->id;
			$this->online = true;
		}
	}

	/**
	 * This method unsets user_id in this class and session.
	 */
	public function logout() {
		unset ( $_SESSION ['user_id'] );
		unset ( $this->user_id );
		$this->online = false;
	}

	/**
	 * This method returns whether the user has logged in.
	 */
	public function is_online() {
		return $this->online;
	}
	
	/**
	 * This method assgins message to session if a message is given,
	 * if not, then return the message in this class.
	 * Note: message assgin to session will be retrieved in the constructor.
	 */
	public function message($msg = "") {
		if (! empty ( $msg )) {
			$this->message[] = $msg;
			$_SESSION ["message"] = $this->message;
		} else {
			$output = "";
			if(!empty ( $this->message )) {
				$output .= "<div class=\"message\">";
				$output .= "(*･ω･): ";
				$output .= "<ul>";
				if(is_array($this->message)){
					foreach ( $this->message as $key => $msg ) {
						$output .= "<li>";
						$output .= htmlentities ( $msg );
						$output .= "</li>";
					}
				}
				$output .= "</ul>";
				$output .= "</div>";
			}
			unset($_SESSION['message']);
			$this->message = "";
			return $output;
		}
	}
	
	/**
	 * This method appends message to session if a message is given,
	 * if not, then this does nothing.
	 */
	public function append_error_message($error = "") {
		if (! empty ( $error )) {
			$this->errors[] = $error;
			$_SESSION ["error"] = $this->errors;
		}
	}

	/**
	 * This method generate html error code to display.
	 */
	public function get_form_errors() {
		$output = "";
		if(!empty ( $this->errors )) {
			$output .= "<div class=\"error\">";
			$output .= "ᶘ ᵒᴥᵒᶅ :";
			$output .= "<ul>";
			foreach ( $this->errors as $key => $error ) {
				$output .= "<li>";
				$output .= htmlentities ( $error );
				$output .= "</li>";
			}
			$output .= "</ul>";
			$output .= "</div>";
		}
		unset($_SESSION ['error'] );
		$this->errors = array ();
		return $output;
	}
	
}

$session = new Session ();

?>