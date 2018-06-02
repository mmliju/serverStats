<?php
//page to handle AJAX request
if(isset($_POST['server_name']))
{
	require("classes/main.class.php");
	$mainObj = new main();
	//------------------------------------
	$server = $_POST['server_name'];
	$mainObj->get_server_details($server);
}
?>