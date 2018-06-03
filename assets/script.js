// JavaScript Document
$(document).ready(function(){
	$("#loader").css("display", "none");
	$("#server_list").change(function(){//Triggers when selects the server
	 var server = $('#server_list').val();
	 $("#loader").css("display", "block");
		//--------Fetching contents -------------------
		$.post("remote.php",
		{
			server_name: server
		},
		function(data, status){
			var stat_arr = JSON.parse(data);
			var x = [];
			var y = [];
			if(stat_arr.result == "Error")//----error in fetching data from api----
			{
				var config = {
					type: 'line',
					data: {
						datasets: [{
							label: 'Error in loading data',
							backgroundColor: window.chartColors.red,
							borderColor: window.chartColors.red,
							data: x,
							fill: false,
						}]
					}};
			}
			else
			{
				$.each(stat_arr, function(key, value){
					x.push(key); 
					y.push(value); 
					
				});
				//==========================================================================
				var config = {
					type: 'line',
					data: {
						labels: x,
						datasets: [{
							label: 'Statistical values',
							backgroundColor: window.chartColors.blue,
							borderColor: window.chartColors.blue,
							data: y,
							fill: false,
						}]
					},
					options: {
						responsive: true,
						title: {
							display: true,
							text: 'Statistical values for '+server+''
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
									labelString: 'Time'
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
			}
			//----------------setting up graph-----------------------
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
			$("#loader").css("display", "none");
//=======================================================================================	
		});
	}); 
}); 
		
