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

?>