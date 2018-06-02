<?php
error_reporting(0);
require("classes/main.class.php");
$mainObj = new main();
$server_drop_down = $mainObj->get_server_list();
?>
 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Server Statistics Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">
<header>
 <div class="header">
   <h1>Server Statistics</h1>
   <p>Server statistics monitoring tool</p>
    <div class="horline"> </div>
 </div>
</header>
    <div class="row">
      <div class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading">Select your server</div>
        <div class="panel-body"><?php echo $server_drop_down; ?></div>
      </div>
      </div>
      <div class="col-sm-8">
      	<div class="well well-lg">
        <div id="loader"></div>
      	<canvas id="canvas"></canvas>
        </div>
        </div>
    </div> 
  <footer>
   <div class="horline"> </div>
  
 </footer>
</div>
  
</div> 
</body>
</html> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
  <script src="assets/utils.js"></script>
  <script src="assets/script.js"></script>