<?php

class User extends DatabaseObject{
	protected static $table_name = "user";
	protected static $db_fields = array (
		'id', 'name'
	);
	public $id, $name;
}

class Room extends DatabaseObject{
	protected static $table_name = "room";
	protected static $db_fields = array (
		'id','user_id'
	);
	public $id, $user_id;

	public static function find_by_host_user_id($user_id){
		User::find_by_field_index(1, $user_id);
	}
}

class RoomUser extends Junction_object_reference{
	protected static $table_name = "room_user";
	protected static $db_fields = array (
		'room_id', 'user_id'
	);
	public $room_id, $user_id;
}

class Character extends DatabaseObject{
	protected static $table_name = "character_card";
	protected static $db_fields = array (
		'id','theme_id', 'script_id', 'name', 'ability'
	);
	public $id, $theme_id, $script_id, $name, $ability;

	public static function get_random_by_theme_id($theme_id){
		#TODO
	}
}

class Equipment extends DatabaseObject{
	protected static $table_name = "equipment_card";
	protected static $db_fields = array (
		'id','theme_id', 'script_id', 'name', 'ability'
	);
	public $id, $theme_id, $script_id, $name, $ability;

	public static function get_random_by_theme_id($theme_id){
		#TODO
	}
}

class Status extends DatabaseObject{
	protected static $table_name = "status_card";
	protected static $db_fields = array (
		'id','theme_id', 'script_id', 'description'
	);
	public $id, $theme_id, $script_id, $description;

	public static function get_random_by_theme_id($theme_id){
		#TODO
	}
}

?>