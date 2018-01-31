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
<a>Hello, the database is connected! If not you will be redirected.</a>
<br/>
<a id="hello"></a>
<script>
	// For any text on screen, please use echo_text() from includes/site_class/text.php
	// PHP is a preprocessor, which means, before the code is send as a HTML to the viewer
	// Any <?php ?> tag will be processed on the server side, so you may write as follow
	document.getElementById("hello").innerHTML = " <?php echo_text("footer_info"); ?> ";


	// Show 3 buttons on the screen

</script>
<?php include_layout_template('footer.php'); ?>

