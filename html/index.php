<!-- Set environment and debug flag-->
<?php
    require_once('../includes/config.php');
    $debug_mode     = false; 
    $database_save  = true;
    if($debug_mode) { var_dump($session); }
?>

<!-- Process login information if needed -->

<!-- Show welcome information -->
<?php echo_html_header($text['home_title']); ?>
<script type="text/javascript" src="javascript/view.js"></script>
<body id="main_body">Hello world</body>
<?php include_layout_template('footer.php'); ?>

