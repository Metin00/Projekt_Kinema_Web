
<?php
include("teDrejtaAdmin.php");

?>
<html>
	<head>
		<script src="jquery-3.3.1.js"></script>
		<script type="text/javascript" src="Chart.min.js"></script>
		<script type="text/javascript" src="graphsJS.js"></script>
			
		<style type="text/css">
			#chart-container{
				width: 640px;
				height: auto;
			}
		<style>
	</head>

	<body>

		<div id = 'chart-container'>
			<canvas id='graph-canvas'></canvas>
		</div>
    
		<script>
		$(document).ready(function(){
	$.ajax({
		url: "http://localhost:1234/projekt_kinema/teDhenaGrafikePhP.php",
		method: "GET",
		success: function(data) {
			//Test
			console.log(data);
			
			var title = [];
			var imdb2 = [];
			data = JSON.parse(data);
			
			for (var i in data){
				title.push(data[i].titulli);
				imdb2.push(data[i].IMDB);
			}
			
			// Krijimi i te dhenave chart
			var chartData = {
				labels: title,
				datasets: [
					{
						label: 'IMDB',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: imdb2
					}
				]
			};
			//Test
			alert(chartData);
				
			var ctx = $("#graph-canvas");
			
			
			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data){
			console.log(data);
		}
	});
});
		</script>
	
	</body>
	
</html>