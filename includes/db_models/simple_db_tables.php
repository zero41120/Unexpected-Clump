<?php

class Id_name_reference extends DatabaseObject{
	protected static $db_fields = array (
		'id', 'name'
	);
	public $id, $name;
	public static function find_by_id_comma_sep_list($ids, $limit = 100){
		global $db_connect;
		if (empty($ids)) { return false; }
		$query  = " SELECT * FROM " . static::$table_name;
		$query .= " WHERE id in (" . $db_connect->escape_value($ids) . ")";
		$query .= " LIMIT " . $db_connect->escape_value($limit);
		$result_array = static::find_by_sql($query);
		return !empty($result_array) ? $result_array : false;
	}
}

class User extends Id_name_reference{
	protected static $table_name = "user";
}
class Theme extends Id_name_reference{
	protected static $table_name = "theme";
}



class Room extends DatabaseObject{
	protected static $table_name = "room";
	protected static $db_fields = array (
		'id','user_id'
	);
	public $id, $user_id;

	public static function find_by_host_user_id($user_id){
		return static::find_by_field_index(1, $user_id, false);
	}
}

class Room_user extends Junction_object_reference{
	protected static $table_name = "room_user";
	protected static $db_fields = array (
		'room_id', 'user_id'
	);
	public $room_id, $user_id;
}

class Room_theme extends Junction_object_reference{
	protected static $table_name = "room_theme";
	protected static $db_fields = array (
		'room_id', 'theme_id'
	);
	public $room_id, $theme_id;
}


class Submitted_info extends DatabaseObject{
	protected static $table_name = "submitted_info";
	protected static $db_fields = array (
		'id', 'room_id', 'player_id', 
		'equipment_card_id', 'character_card_id', 'status_card_id'
	);
	public $room_id, $player_id;
	public $equipment_card_id, $character_card_id, $status_card_id;
	public static function find_by_room_id($room_id){
		return static::find_by_field_index(1, $room_id);
	}
	public static function delete_by_room_id($room_id){
		global $db_connect;
		$query = "DELETE FROM " . static::$table_name;
		$query .= " WHERE room_id = " . $room_id; 
		$db_connect->query ( $query );
		return true;
	}
}
?>