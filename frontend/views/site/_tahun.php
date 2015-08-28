
<?php

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Fakta */
/* @var $form yii\widgets\ActiveForm */
?>

<script>
function outputUpdate(vol) {
$('#judulTahun').html('Tahun: ');
$('#tahunnya').html(tahun[vol]);
setVariableTahun(tahun[vol]);
indexTahun=vol;
}

function tahunNext() {
if(indexTahun<(tahun.length-1))
{
$('#tahunnya').html(tahun[(indexTahun+1)]);
$('#tahunInput').html('<input type=range min=0 max='+(tahun.length-1)+' value='+(indexTahun+1)+' id=fader step=1 oninput="outputUpdate(value)">');
indexTahun++;	
setVariableTahun(tahun[indexTahun]);
}
}

function tahunBack() {
if(indexTahun!=0)
{
$('#tahunnya').html(tahun[(indexTahun-1)]);
$('#tahunInput').html('<input type=range min=0 max='+(tahun.length-1)+' value='+(indexTahun-1)+' id=fader step=1 oninput="outputUpdate(value)">');
indexTahun--;	
setVariableTahun(tahun[indexTahun]);
}
}

function tahunPlay(){
var startTime = 0;
var interval = setInterval(function(){
    if(startTime == tahun.length ){
        clearInterval(interval);
	$('#loadingmap').html('');
        return;
    }
	else {
		$('#tahunInput').html('<input type=range min=0 max='+(tahun.length-1)+' value='+startTime+' id=fader step=1 oninput="outputUpdate(value)">');
		$('#tahunnya').html(tahun[startTime]);
setVariableTahun(tahun[startTime]);
$('#loadingmap').html('<h1 style="margin-Left:6%"><b>'+tahun[startTime]+'</b></h1>')
		startTime++;
	}
}, 1000);

}
</script>

<div class="row">
		<div class="col-md-3">
		<div class="row">
		<div class="col-md-8">
		<label for=tahun id="judulTahun" style="margin-bottom:0"></label> 
		</div>
		<div class="col-md-4" id="uplay" style="position:relative;">
		</div>
		</div>
		</div>
		<div class="col-md-6" ><div id="tahunInput"></div>
		</div>
		<div class="col-md-3" >
		
		<span class="glyphicon glyphicon-triangle-left" aria-hidden="true" onclick="tahunBack()"></span><span class="glyphicon glyphicon-triangle-right" aria-hidden="true" onclick="tahunNext()"></span>
		<label for=tahun id="tahunnya" style="margin-bottom:0"></label>
		
		
		
		</div>
		</div>



