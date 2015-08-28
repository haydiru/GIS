<?php
?>
<div class="panel panel-success" >
<div class="panel-body" id="grafikS">
</div>
</div>
<script>

function grafikPeta(namawilayah,isdata){
	$('#grafikS').html('<canvas id="myChart" style="width: 100% !important;height: 300px !important;"></canvas>');
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
			//responsive : true,
			 animation: false,
		});

}

function grafikPetaline(e){
	var isdata=new Array();
	var idWill= e.target.feature.properties.ID;
	  layerPopup = L.popup()
   .setLatLng(e.latlng) 
   .setContent('<div id="lineChart" style="width:200px; height:200px"></div>')
   .openOn(map);

	for(var i=0;i<tahun.length;i++)
	{
		isdata[i]=dataTabel[tahun[i]][idWill];
	}
	$('#lineChart').html('<canvas id="myChartline" style="width: 100% !important;height: 100% !important;"></canvas>');
	var barChartData = {
		labels : tahun,
		datasets : [
			{
				fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
				data : isdata
			}
		]

	}
	
	var ctx = document.getElementById("myChartline").getContext("2d");
		myNewChart = new Chart(ctx).Line(barChartData, {
			//responsive : true,
			 pointHitDetectionRadius : 3,
			 pointDotRadius : 3,
			 //animation: false,
		});

}

	</script>