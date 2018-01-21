<?php
class DatabaseObject {
	/**
	 * Subclass of this class should have an array of db_fields,
	 * which should always be identical to the db field names.
	 *
	 * For each field, it needs to have a variable to hold the data.
	 */
	protected static $db_fields = array ();

	/**
	 * This function returns array of the query results.
	 */
	public static function find_by_sql($query = "", $connection = "") {
		if(empty($connection)){
			global $db_connect;
		} else {
			$db_connect = $connection;
		}
		$result_set   = $db_connect->query ( $query );
		$object_array = array ();
		while($row = $db_connect->fetch_array($result_set)){
			$object_array [] = static::instantiate ( $row );
		}
		return $object_array;
	}

	/**
	 * This function takes a result_array,
	 * retrieves its row as attribute => value,
	 * checks and assgins if db_fields has the same name.
	 */
	protected static function instantiate($record) {
		$object = new static();
		foreach ( $record as $attribute => $value ) {
			if ($object->has_attribute($attribute)) {
				$object->$attribute = $value;
			}
		}
		return $object;
	}

	/**
	 * This method checks if key exists in the db_field array.
	 */
	protected function has_attribute($attribute) {
		return array_key_exists($attribute, $this->get_attribute_array());
	}

	/**
	 * This method gets the attribute array of the db_field.
	 * includeID 
	 *		indicates if the return array should contrain id.
	 */
	protected function get_attribute_array($includeID = true) {
		// return an array of attribute names and their values
		$attributes = array();
		foreach (static::$db_fields as $field) {
			if (property_exists($this, $field)) {
				if ($includeID == false && $field == "id") {
					continue;
				}
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}

	/**
	 * This function gets the attribute array of the escped db_field value.
	 */
	protected function get_attribute_array_escaped($includeID = true) {
		global $db_connect;
		$clean_attributes = array();
		foreach ($this->get_attribute_array ($includeID) as $key => $value){
			if ($includeID == false && $key == "id") {
				continue;
			}
			$clean_attributes[$key] = $db_connect->escape_value($value);
		}
		return $clean_attributes;
	}

	// This method deletes this object in the database by its id.
	public function delete() {
		global $db_connect;
		
		$query = "DELETE FROM " . static::$table_name . " WHERE id = ";
		$query .= "$this->id";
		$query .= " LIMIT 1";
		$db_connect->query ( $query );
		return ($db_connect->affected_rows () == 1) ? true : false;
	}


	// This method will save this object by update if exists or create if not
	public function save($db = "") {
		return isset($this->id) ? $this->update($db) : $this->create($db);
	}

	/**
	 * This method creates a record of this object in the database
	 * and acquires its id from the database.
	 */
	protected function create($db) {
		if(empty($db)){
			global $db_connect;
		} else {
			$db_connect = $db;
		}
		
		$attributes = $this->get_attribute_array_escaped(false);
		foreach ($attributes as $key => $value){
			if ($value == null) {
				unset ($attributes [$key]);
			}
		}
		$query = "INSERT INTO " . static::$table_name . " (";
		$query .= join ( ", ", array_keys($attributes));
		$query .= ") VALUES ('";
		$query .= join ( "', '", array_values ( $attributes ) );
		$query .= "')";
		$query = str_replace ( "''", "NULL", $query );
		if ($db_connect->query ( $query )) {
			$this->id = $db_connect->insert_id ();
			return true;
		} else {
			return false;
		}
	}

	// This method updates a record of this object in the database by its ID
	protected function update($db) {
		if(empty($db)){
			global $db_connect;
		} else {
			$db_connect = $db;
		}
		$attributes = $this->get_attribute_array_escaped ( false );
		$attribute_pairs = array ();
		foreach ( $attributes as $key => $value ) {
			if ($value == null) {
				continue;
			}
			$attribute_pairs [] = "{$key}='{$value}'";
		}
		$query = "UPDATE " . static::$table_name . " SET ";
		$query .= join ( ", ", $attribute_pairs );
		$query .= " WHERE id=" . $db_connect->escape_value ( $this->id );
		$db_connect->query ( $query );
		return ($db_connect->affected_rows () == 1) ? true : false;
	}


	//
	// Functions below are really useful
	//

	// This function uses find_by_sql() to get all the data. 
	public static function find_all($limit = 0, $offset = 0) {
		$query = "SELECT * FROM " . static::$table_name;
		$query .= empty($limit) ? "" : " LIMIT {$limit} ";
		$query .= empty($offset)? "" : " OFFSET {$offset} ";
		return static::find_by_sql($query);
	}

	// This function uses find_by_sql() to get the data of a specified id. 
	public static function find_by_id($id = 0) {
		global $db_connect;
		if (empty($id)) { return false; }
		$query  = " SELECT * FROM " . static::$table_name;
		$query .= " WHERE id = " . $db_connect->escape_value ($id);
		$result_array = static::find_by_sql($query);
		return !empty($result_array) ? array_shift($result_array) : false;
	}

	// This function counts the data in the table.
	public static function count_all() {
		global $db_connect;
		$query = "SELECT COUNT(*) FROM " . static::$table_name;
		$result_set = $db_connect->query ( $query );
		$row = $db_connect->fetch_array ( $result_set );
		return array_shift ( $row );
	}

	public static function find_by_field_index($index, $value, $all = true, $connect = ""){
		if(empty($connect)) {
			global $db_connect;
		} else {
			$db_connect = $connect;
		}
		if(empty($value)) { return false; }
		$query  = " SELECT ";
		$query .= join ( ", t.", array_values(static::$db_fields));
		$query .= " FROM " . static::$table_name . " AS t ";
		$query .= " WHERE  ". static::$db_fields[$index] ."="; 
		$query .= "'" . $db_connect->escape_value($value) . "'";
		if($all){
			return static::find_by_sql($query, $db_connect);
		} else {
			$result_array = static::find_by_sql($query, $db_connect);
			return !empty($result_array) ? array_shift($result_array) : false;
		}
	}
}


class ID_reference extends DatabaseObject {
	/**
	 * This class for table wiht only id and name
	 * and useful methods designed for such class.
	 */
	protected static $db_fields = array (
			'id',
			'name' 
	);
	public $id;
	public $name;
	public static function get_id_to_name_reference_array() {
		$combined_types = static::find_all ();
		$type_array = array ();
		foreach ( $combined_types as $combined_type ) {
			$type_array [$combined_type->id] = $combined_type->name;
		}
		unset ( $combined_types );
		return $type_array;
	}
	public static function find_by_name($name = "") {
		global $db_connect;
		$query  = " SELECT * FROM " . static::$table_name;
		$query .= " WHERE name = '" . $db_connect->escape_value($name) . "'";
		$query .= " LIMIT 1 ";
		$result_array = static::find_by_sql($query );
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	public static function output_name_by_id($id) {
		$temp = static::find_by_id($id);
		return $temp->name;
	}
	public static function output_id_by_name($name) {
		$temp = static::find_by_name($name);
		return $temp->id;
	}
}


class Junction_object_reference extends DatabaseObject {
	/**
	 * This is a special class designed for conjunction table,
	 * a conjunction table has 2 ids in the db_field, 
	 * each represents a foreign key id reference to another table.
	 */
	public static function delete_junction($first_id, $second_id) {
		global $db_connect;
		$query  = " DELETE FROM " . static::$table_name;
		$query .= " WHERE " . static::$db_fields[0];
		$query .= " = " . $db_connect->escape_value($first_id);
		$query .= " AND " . static::$db_fields[1];
		$query .= " = " . $db_connect->escape_value($second_id);
		$query .= " LIMIT 1";
		$db_connect->query ( $query );
		return ($db_connect->affected_rows() > 0) ? true : false;
	}
	public static function is_this_pair_exists($first_id, $second_id) {
		global $db_connect;
		if(empty($first_id) || empty($second_id)) { return false; }

		$query  = " SELECT * FROM " . static::$table_name;
		$query .= " WHERE " . static::$db_fields[0]; 
		$query .= " = " . $db_connect->escape_value($first_id);
		$query .= " AND " . static::$db_fields[1]; 
		$query .= " = " . $db_connect->escape_value($second_id);
		$query .= " LIMIT 1";
		$db_connect->query ( $query );
		return ($db_connect->affected_rows() > 0) ? true : false;
	}

	public static function find_by_first_id($id = 0) {
		global $db_connect;
		if (empty ( $id )) { return false; }
		$query  = " SELECT * FROM " . static::$table_name;
		$query .= " WHERE " . static::$db_fields [0] . " = " . $db_connect->escape_value ( $id );
		$result_array = static::find_by_sql ( $query );
		return !empty($result_array) ? $result_array : false;
	}
	public static function find_by_second_id($id = 0) {
		global $db_connect;
		if (empty ( $id )) { return false; }
		$query  = " SELECT * FROM " . static::$table_name;
		$query .= " WHERE " . static::$db_fields [1];
		$query .= " = " . $db_connect->escape_value($id);
		$result_array = static::find_by_sql($query);
		return !empty($result_array) ? $result_array : false;
	}
}
?>
