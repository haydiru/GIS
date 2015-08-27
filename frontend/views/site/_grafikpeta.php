<?php
?>
<div id="grafikS"></div>

<script>

function grafikPeta(namawilayah,isdata){
	$('#grafikS').html('<canvas id="myChart" width="100%" height="50px"></canvas>');
	var myNewChart;
	var barChartData = {
		labels : namawilayah,
		datasets : [
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data : isdata
			}
		]

	}
	
	var ctx = document.getElementById("myChart").getContext("2d");
		myNewChart = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
myNewChart.update();
}

	</script>