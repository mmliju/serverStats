<?php
require("classes/main.class.php");
$mainObj = new main();
//------------------------------------
$server = $_POST['server_name'];
$mainObj->get_server_details($server);
?>