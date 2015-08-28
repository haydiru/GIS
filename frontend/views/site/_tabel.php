
<?php

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Fakta */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="table-responsive">
<table class="table table-striped table-y-border" id="tabel-dinamis">
</table>
</div>
<script>
    function drawTable() {
			$('#tabel-dinamis').html('');
			$('#tabel-dinamis').append('<thead id="tbhead"></thead>');
			$('#tbhead').append('<tr id="barishead"></tr>');
			$('#barishead').append('<th>Nama Wilayah</th>');			
			for (var c = 0; c < tahun.length; c++) {
			$('#barishead').append('<th>'+tahun[c]+'</th>');	
			}
			$('#tabel-dinamis').append('<tbody id="tbbody"></tbody>');
        for (var r = 0; r < idProvinsi.length; r++) {
			$('#tbhead').append('<tr id="barisbody'+r+'"></tr>');
			$('#barisbody'+r).append('<th>'+namaProvinsi[idProvinsi[r]]+'</th>');
             for (var c = 0; c < tahun.length; c++) {
			$('#barisbody'+r).append('<th>'+dataTabel[tahun[c]][idProvinsi[r]]+'</th>'); 
            }
        }
	
}



 function drawTable1() {
			var div1 = document.getElementById('tabel-dinamis');
			$('#tabel-dinamis').html('');
			var heads = document.createElement("thead");
			var row = document.createElement("tr");
			var col = document.createElement("th");
			col.appendChild(document.createTextNode('Nama Wilayah'));
			row.appendChild(col);
			console.log(tahun);
			for (var c = 0; c < tahun.length; c++) {
				var col0 = document.createElement("th");
				col0.appendChild(document.createTextNode(tahun[c]));
				row.appendChild(col0);

			}
			heads.appendChild(row);
			div1.appendChild(heads);
			var tbod = document.createElement("tbody");
        for (var r = 0; r < idProvinsi.length; r++) {
			var row1 = document.createElement("tr");
			var col1 = document.createElement("th");
			col1.appendChild(document.createTextNode(namaProvinsi[idProvinsi[r]]));
			row1.appendChild(col1);
             for (var c = 0; c < tahun.length; c++) {
			var col2 = document.createElement("th");	 
			col2.appendChild(document.createTextNode(dataTabel[tahun[c]][idProvinsi[r]]));
			
			row1.appendChild(col2);
            }           
            
	tbod.appendChild(row1);
        }
    
     div1.appendChild(tbod);


}



function calldata(aWil){
	loadingt(0);
	var aKat = $('#kategori-nama').val();
	var aVarn = $('#variabel-nama').val();
	var aVar = aVarn.substring(10);
	var ta = new Array();
	var idP = new Array();
	var nP = new Array();
	var bu= new Array();
	indexTahun=0;
		
	$.ajax({
url: '?r=site/data&wil='+aWil+'&var='+aVar+'&kat='+aKat,
		type : 'POST',
		dataType : 'json',
success: function(data)   
		{

			var j = 0;
			data.data.forEach(function(entry) {
				
				idP[j]=entry.id_wilayah;
				namaProvinsi[entry.id_wilayah]=entry.nama_wilayah;
				if(entry.id_bulan==0) ta[j]=entry.tahun;
				else ta[j]=entry.nama_bulan+" "+entry.tahun;
				
				if(dataTabel[ta[j]]==null){
				dataTabel[ta[j]] = new Array();
				}
				else ;
				dataTabel[ta[j]][entry.id_wilayah]= Number(entry.nilai);
				j++;
			});
			idProvinsi=jQuery.unique(idP);
			idProvinsi.sort();
			tahun=jQuery.unique(ta);
			$('#judulTahun').html('Tahun: ');
			$('#tahunnya').html(tahun[indexTahun]);
			$('#tahunInput').html('<input type=range min=0 max='+(tahun.length-1)+' value=0 id=fader step=1 oninput="outputUpdate(value)">');
			$('#uplay').html('<a><span class="glyphicon glyphicon-expand" style="cursor: pointer; font-size: 25px; position:absolute; top:-3px;left:3px;" aria-hidden="true" onclick="tahunPlay()" data-toggle="tooltip" data-placement="top" title="Mulai Animasi"></span></a>');
drawTable();
		}
		
	});
	if(aWil!=kodewilayah){
	callProvMap(aWil);
	
	}
	else {setVariableTahun(tahun[indexTahun]);
	loadingt(100);
	}
}
</script>
