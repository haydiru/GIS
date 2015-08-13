<?php
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>



<?php
// Top most parent
$form=ActiveForm::begin();
$tipeWilayah= new \common\models\TipeWilayah();
echo $form->field($tipeWilayah, 'nama')->widget(Select2::classname(), [
'data' => ArrayHelper::map($tipeWilayah::find()->all(), 'id', 'nama'),
'options' => ['placeholder' => 'Select a state ...'],
'pluginOptions' => [
'allowClear' => true
],
])->label('Tipe Wilayah');

// Child level 1
$topik= new \common\models\Topik();
echo $form->field($topik, 'nama')->widget(DepDrop::classname(), [
//  'data'=> ['selected'=>'Bank'],
'options' => ['placeholder' => 'Select ...'],
'type' => DepDrop::TYPE_SELECT2,
'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
'pluginOptions'=>[
'depends'=>['tipewilayah-nama'],
'url' => Url::to(['/site/child']),
'loadingText' => 'Loading child level 1 ...',
]
])->label('Topik & Variabel');
echo Html::button('<i class="glyphicon glyphicon-upload"></i> Generate', ['onclick'=>'callJumlahPenduduk()']);
/*
$variabel=new \common\models\Variabel();
// Child level 2
echo $form->field($variabel, 'nama')->widget(DepDrop::classname(), [
//    'data'=> [9=>'Savings'],
'options' => ['placeholder' => 'Select ...'],
'type' => DepDrop::TYPE_SELECT2,
'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
'pluginOptions'=>[
'depends'=>['topik-nama'],
'url' => Url::to(['/site/child-variabel']),
'loadingText' => 'Loading Tahun ...',
]
]);


// Child level 3
echo $form->field($account, 'lev3')->widget(DepDrop::classname(), [
	'data'=> [12=>'Savings A/C 2'],
	'options' => ['placeholder' => 'Select ...'],
	'type' => DepDrop::TYPE_SELECT2,
	'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
	'pluginOptions'=>[
		'depends'=>['account-lev2'],
		'initialize' => true,
		'initDepends'=>['account-lev0'],
		'url' => Url::to(['/account/child-account']),
		'loadingText' => 'Loading child level 3 ...'
	]
]);
*/
ActiveForm::end();
?>


<div id="variables" class="menu-ui">Tahun : </div>
<div id="map"></div>


