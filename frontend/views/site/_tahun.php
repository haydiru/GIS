
<?php

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Fakta */
/* @var $form yii\widgets\ActiveForm */
?>

<script>
var values = [2001,2005,2006,2015];


function outputUpdate(vol) {

  document.querySelector('#volume').value =tahun[vol];

}

</script>

<div class="row">
		<div class="col-md-6"><label for=tahun>Tahun: </label> 
		</div><div class="col-md-6" ><output for=fader id=volume></output>
		</div>
		</div>

<div id="tahunInput"></div>

