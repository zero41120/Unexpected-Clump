<?php
	
class Themed_table extends DatabaseObject{
	// This method gets random rows by given ids.
	// If ids is empty, get random rows from entire table.
	public static function get_random_by_theme_comma_sep_list($ids, $limit = 3){
		global $db_connect;
		$query  = " SELECT * FROM " . static::$table_name;
		if (!empty($ids)) { 
			$query .= " WHERE theme_id in (" . $db_connect->escape_value($ids) . ")";
		}
		$query .= " ORDER BY RAND() ";
		$query .= " LIMIT " . $db_connect->escape_value($limit);
		$result_array = static::find_by_sql($query);
		return !empty($result_array) ? $result_array : false;
	}
}

class Regular_card extends Themed_table{
	protected static $db_fields = array (
		'id','theme_id', 'script_id', 'name', 'ability'
	);
	public $id, $theme_id, $script_id, $name, $ability, $image;
}

class Character extends Regular_card{
	public $image = "images/card3.png";
	protected static $table_name = "character_card";
}

class Equipment extends Regular_card{
	public $image = "images/card2.png";
	protected static $table_name = "equipment_card";
}

class Status extends Themed_table{
	public $image = "images/card1.png";
	protected static $table_name = "status_card";
	protected static $db_fields = array (
		'id','theme_id', 'script_id', 'description'
	);
	public $id, $theme_id, $script_id, $description;
}


?>