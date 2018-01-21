<!-- Set environment and debug flag-->

<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
    require_once('../includes/config.php');
    $debug_mode     = false; 
    $database_save  = true;
    if($debug_mode) { var_dump($session); }
?>

<!-- Process login information if needed -->

<!-- Show welcome information -->
<?php echo_html_header(get_text('home_title')); ?>
<a>Hello world, database is connected!</a>
<?php include_layout_template('footer.php'); ?>

