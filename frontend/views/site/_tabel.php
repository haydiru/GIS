
<?php

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Fakta */
/* @var $form yii\widgets\ActiveForm */
?>
<table class="table table-striped table-y-border">

<thead>
<tr>
<th>Nama Wilayah</th>
<th>Tahun</th>
<th>Nilai</th>
</tr>
</thead>
<tbody id="tabel-dinamis">

<script>
var totalRows = 5;
var cellsInRow = 5;
var min = 1;
var max = 10;

    function drawTable() {
        var div1 = document.getElementById('tabel-dinamis');
        var tbl = document.createElement("table");
        for (var r = 0; r < totalRows; r++) {
            var row = document.createElement("tr");
             for (var c = 0; c < cellsInRow; c++) {
                var cell = document.createElement("td");
		getRandom = Math.floor(Math.random() * (max - min + 1)) + min;
                var cellText = document.createTextNode(Math.floor(Math.random() * (max - min + 1)) + min);
                cell.appendChild(cellText);
                row.appendChild(cell);
            }           
            
	tbl.appendChild(row);
        }
    
     div1.appendChild(tbl); // appends <table> into <div1>
}

function calldata(){
	var dataTabel = new Array();
	var aVarn = $('#variabel-nama').val();
	var aVar = aVarn.substring(10);
	var aWil = $('#wilayah-nama').val();
	var aKat = $('#kategori-nama').val();
	var ta = new Array();
	var idP = new Array();
	var nP = new Array();
	var bu= new Array();
	
	$.ajax({
url: '?r=site/data&wil='+aWil+'&var='+aVar+'&kat='+aKat,
		type : 'POST',
		dataType : 'json',
success: function(data)   
		{
			var div1 = document.getElementById('tabel-dinamis');
			$('#tabel-dinamis').html('');
			var j = 0;
			data.data.forEach(function(entry) {
				idP[j]=entry.id_wilayah;
				nP[j]=entry.nama_wilayah;
				ta[j]=entry.tahun;
				jp[j]=Number(entry.nilai);
				if(dataTabel[entry.id_wilayah]==null){
				dataTabel[entry.id_wilayah] = new Array();
				if(dataTabel[entry.id_wilayah][entry.nama_wilayah]==null){
				dataTabel[entry.id_wilayah][entry.nama_wilayah] = new Array();
				}
				else ;
				}
				else ;
				dataTabel[entry.id_wilayah][entry.nama_wilayah][entry.tahun]= entry.nilai;
				j++;
			});
			idProvinsi=jQuery.unique(idP);
			namaProvinsi=jQuery.unique(nP);
			tahun=jQuery.unique(ta);
			console.log(idProvinsi);
			console.log(namaProvinsi);
			console.log(tahun);
			console.log(jp);
			$('#tahunInput').html('<input type=range min=0 max='+(tahun.length-1)+' value=0 id=fader step=1 oninput="outputUpdate(value)">');
		serie = new geostats(jp);
		serie.getClassJenks(4);
	var ranges = serie.getRanges();
	
console.log(ranges.getRangeNum());
		//	data.data.forEach(function(dataTabelWilayah) {
		//	var row = document.createElement("tr");
		//	var cell = document.createElement("td");
		//	var cell1 = document.createElement("td");
		//	var cell2 = document.createElement("td");
        //    cell.appendChild(document.createTextNode(entry.nama_wilayah));
		//	cell1.appendChild(document.createTextNode(entry.tahun));
		//	cell2.appendChild(document.createTextNode(entry.nilai));
        //    row.appendChild(cell);
		//	row.appendChild(cell1);
		//	row.appendChild(cell2);
		//	div1.appendChild(row);
		//	console.log(entry.nama_wilayah);
		//	});

		}
	});
}
</script>
<?php
if($tabel!=null){
foreach ($tabel as $baris) {
echo '<tr>';
echo '<td>'.$baris['nama_wilayah'].'</td>';
echo '<td>'.$baris['tahun'].'</td>';
echo '<td>'.$baris['nilai'].'</td>';
echo '</tr>';
}
}
?>
</tbody>
</table>
