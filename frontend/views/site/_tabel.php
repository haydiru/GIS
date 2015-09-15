
<?php

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Fakta */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="modal fade" id="myModalTabel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
	  
      <div class="table-responsive">
<table class="table table-hover" id="tabel-dinamis">
</table>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script>
    function drawTable() {
		$('#myModalLabel').html(judul);
		$('#untukTabel').html('<span class="glyphicon glyphicon-list-alt" style="cursor: pointer" aria-hidden="true" data-toggle="modal" data-target="#myModalTabel" data-toggle="tooltip" data-placement="top" title="Tampilkan Data"></span>');
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
			$('#barisbody'+r).append('<th style="font-weight: normal">'+namaProvinsi[idProvinsi[r]]+'</th>');
             for (var c = 0; c < tahun.length; c++) {
			$('#barisbody'+r).append('<th style="font-weight: normal">'+dataTabel[tahun[c]][idProvinsi[r]]+'</th>'); 
            }
        }
	
}



function calldata(aWil){
	loadingt(0);
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
idProvinsi.splice(0, idProvinsi.length);
	tahun.splice(0, tahun.length);
			var j = 0;
			data.data.forEach(function(entry) {
				//tampung id willayah
				idP[j]=entry.id_wilayah;
				//tampung nama willayah
				namaProvinsi[entry.id_wilayah]=entry.nama_wilayah;
				//tampung tipe wilayah
				tipeWil[entry.id_wilayah]=entry.tipe;
				//jika tidak ada bulan
				if(entry.id_bulan==0) ta[j]=entry.tahun;
				else ta[j]=entry.nama_bulan+" "+entry.tahun;
				//buat judul
				if(j==0){
				if(aKat==0) judul = entry.nama_variabel+' '+data.namaparent;
				else judul = entry.nama_variabel+' '+entry.nama_katergori+' '+data.namaparent;
				}
				//tampung semua nilai data
				if(dataTabel[ta[j]]==null){
				dataTabel[ta[j]] = new Array();
				}
				else ;
				dataTabel[ta[j]][entry.id_wilayah]= Number(entry.nilai);
				j++;
			});
			//hapus duplikasi id Provinsi
		$.each(idP, function(i, el){
			if($.inArray(el, idProvinsi) === -1) idProvinsi.push(el);
		});
			idProvinsi.sort();
			//hapus duplikasi tahun
			$.each(ta, function(i, el){
			if($.inArray(el, tahun) === -1) tahun.push(el);
		});
			$('#judul').html('<h4><b>'+judul+'</b></h4>');
			$('#judulTahun').html('Tahun: ');
			$('#tahunControl').html('<span class="glyphicon glyphicon-triangle-left" style="cursor: pointer" aria-hidden="true" onclick="tahunBack()" data-toggle="tooltip" data-placement="top" title="Tahun Sebelum"></span><span class="glyphicon glyphicon-triangle-right" style="cursor: pointer" aria-hidden="true" onclick="tahunNext()" data-toggle="tooltip" data-placement="top" title="Tahun Selanjutnya"></span><label for=tahun id="tahunnya" style="margin-bottom:0"></label>');
			$('#tahunInput').html('<input type=range min=0 max='+(tahun.length-1)+' value=0 id=fader step=1 oninput="outputUpdate(value)">');
			$('#uplay').html('<a><span class="glyphicon glyphicon-expand" style="cursor: pointer; font-size: 25px; position:absolute; top:-3px;left:3px;" aria-hidden="true" onclick="tahunPlay()" data-toggle="tooltip" data-placement="top" title="Mulai Animasi"></span></a>');
			$('#tahunnya').html(tahun[indexTahun]);
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
