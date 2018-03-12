<?php
/* This sets the environment path */
defined ( 'DS' ) ? null : define ( 'DS', DIRECTORY_SEPARATOR );
if(file_exists('C:'.DS.'xampp'.DS.'php'.DS.'www')){
	defined ( 'SITE_ROOT' ) ? null : define ( 'SITE_ROOT', 'C:'.DS.'xampp'.DS.'php'.DS.'www');
} else if(file_exists(DS.'var'.DS.'www')){
	defined ( 'SITE_ROOT' ) ? null : define ( 'SITE_ROOT', DS.'var'.DS.'www');
} else {
	defined ( 'SITE_ROOT' ) ? null : define ( 'SITE_ROOT', DS.'Applications'.DS.'MAMP'.DS.'htdocs');
}
defined ( 'LIB_PATH' ) ? null : define ( 'LIB_PATH', SITE_ROOT . DS . 'includes' );


$library_paths = array (
		LIB_PATH . DS . "site_class",
		LIB_PATH . DS . "db_models" 
);

/* Require important class */
require_once (LIB_PATH . DS . "function.php");
require_once (LIB_PATH . DS . "database.php");
require_once (LIB_PATH . DS . "db_object.php");

/* Autoload everything in the library path*/
foreach ( $library_paths as $folder ) {
	foreach ( glob ( "{$folder}/*.php" ) as $filename ) {
		require_once $filename;
	}
}
/* Autoload [class_name].php when a class load is not speicfy */
function __autoload($class_name) {
	global  $library_paths;
	$class_name = strtolower ( $class_name );
	$path = LIB_PATH . DS . "{$class_name}.php";
	if (file_exists ( $path )) {
		require_once ($path);
		return;
	}
	foreach ( $library_paths as $folder ) {
		$path = $folder . DS . $class_name;
		if (file_exists ( $path )) {
			require_once ($path);
			return;
		}
	}
	die ( "The file {$class_name}.php could not be found." );
	
}
?>

