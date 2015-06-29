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
<div class="site-index" >

<div class="jumbotron" >
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
]);
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
echo Html::submitButton('<i class="glyphicon glyphicon-upload"></i> Generate', ['onclick'=>'initializez()']);
/*
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
<div id="map"></div>
</div>



<div class="body-content">

<div class="row">
<div class="col-lg-4">
<h2>Heading</h2>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
fugiat nulla pariatur.</p>

<p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
</div>
<div class="col-lg-4">
<h2>Heading</h2>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
fugiat nulla pariatur.</p>

<p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
</div>
<div class="col-lg-4">
<h2>Heading</h2>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
fugiat nulla pariatur.</p>

<p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
</div>
</div>

</div>
</div>
