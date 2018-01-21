<?php

class Sometable extends DatabaseObject{
	protected static $table_name = "tname";
	protected static $db_fields = array (
		'field1','field2','field3'
	);
	public $field1, $field2, $field3;

	public static function find_by_id($id = "") {
		return static::find_by_field_index(0, $id, false, $game_db);
	}
}

?>