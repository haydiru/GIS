
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
}

</script>

<div class="row">
		<div class="col-md-4"><label for=tahun id="judulTahun" style="margin-botton:0"></label> 
		</div>
		<div class="col-md-4" ><div id="tahunInput"></div>
		</div>
		<div class="col-md-4" ><label for=tahun id="tahunnya" style="margin-botton:0"></label> 
		</div>
		</div>



