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
	
	var idWill= e.target.feature.properties.ID;
	calldatasum('2',idWill,namaProvinsi[idWill]);calldatavis('2',idWill);
	layerPopup = L.popup({maxWidth:700})
   .setLatLng(e.latlng) 
   .setContent('<span id="maxi" class="glyphicon glyphicon-resize-full"  style="cursor: pointer" aria-hidden="true" onclick="maxzoom('+idWill+')"></span><span id="minimize" class="glyphicon glyphicon-resize-small"  style="cursor: pointer" aria-hidden="true" onclick="minimize('+idWill+')"></span><h5>'+namaProvinsi[idWill]+' '+tahun[0]+'-'+tahun[tahun.length-1]+'</h5><div id="lineChart"></div><div id="zoomIn"></div>')
   .openOn(map);
   cekData(idWill);
   $('#minimize').css('display','none');
//buat grafik dalam map
chartpop(idWill);
}

function cekData(aWil){
	
	$.ajax({
url: '?r=site/cekdata&wil='+aWil+'&var='+aVar+'&kat='+aKat,
		type : 'POST',
		dataType : 'json',
success: function(data)   
		{
			if(data.data==1) $('#zoomIn').html('<button onclick="calldata('+aWil+')">Akses data level peta ini</button>');
			else $('#zoomIn').html('')
		}
	});
}

function chartpop(idWill){
	var isdata=new Array();
	for(var i=0;i<tahun.length;i++)
	{
		isdata[i]=dataTabel[tahun[i]][idWill];
	}
	
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
		$('#lineChart').html('<canvas id="myChartline" style="width: 100% !important;height: 100% !important;"></canvas>');
	var ctx = document.getElementById("myChartline").getContext("2d");
	var	myNewChar = new Chart(ctx).Line(barChartData, {
			//responsive : true,
			 pointHitDetectionRadius : 3,
			 pointDotRadius : 3,
			 //animation: false,
		});
}

function maxzoom(idWill){
	$('.leaflet-popup-content').css('width','700px');
	$('#lineChart').css('width','700px');
	$('#maxi').css('display','none');
	$('#minimize').css('display','inline');
chartpop(idWill);
	}
	
function minimize(idWill){
	$('.leaflet-popup-content').css('width','300px');
	$('#lineChart').css('width','200px');
	$('#minimize').css('display','none');
	$('#maxi').css('display','inline');
chartpop(idWill);
	}

	</script>