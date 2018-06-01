<?php
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
  <script src="assets/utils.js"></script>
	<style>
	canvas{
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
</head>
<body>

<div class="container">
  <h1>Server Statistics</h1>
    <div class="row">
      <div class="col-sm-4"><div class="well"> <?php echo $server_drop_down; ?></div></div>
      <div class="col-sm-8"><div class="well well-lg"><canvas id="canvas"></canvas></div></div>
    </div> 
</div>
  
</div> 
</body>
</html> 
<script type="text/javascript">
$(document).ready(function(){
	$("#server_list").change(function(){
		var server = $('#server_list').val();
		//alert(server);
		//--------Fetching contents -------------------
		$.post("remote.php",
		{
			server_name: server
		},
		function(data, status){
			//alert("Data: " + data + "\nStatus: " + status);
			
			var stat_arr = JSON.parse(data);
			var x = [];
			var y = [];
			$.each(stat_arr, function(key, value){
				//console.log(key, value);
				x.push(key); 
				y.push(value); 
				//alert(value);
			});
			//==========================================================================
			var config = {
				type: 'line',
				data: {
					labels: y,
					datasets: [{
						label: 'My First dataset',
						backgroundColor: window.chartColors.red,
						borderColor: window.chartColors.red,
						data: x,
						fill: false,
					}]
				},
				options: {
					responsive: true,
					title: {
						display: true,
						text: 'Server Performance'
					},
					tooltips: {
						mode: 'index',
						intersect: false,
					},
					hover: {
						mode: 'nearest',
						intersect: true
					},
					scales: {
						xAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: 'Month'
							}
						}],
						yAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: 'Value'
							}
						}]
					}
				}
			};

			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
//=======================================================================================	
		});
	}); 
}); 
		
</script>