<?php
/* @var $this yii\web\View */
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div style="padding: 55px 5px 0 5px">
				<div class="panel panel-success" style="margin-bottom:5px;">
		<div class="panel-heading" style="padding:0 5px 0 5px;"><div class="row" >
		<div class="col-md-2" style="padding-right:5px;">
		<?php
		$form=ActiveForm::begin();
$tipeWilayah= new \common\models\TipeWilayah();
echo $form->field($tipeWilayah, 'nama')->widget(Select2::classname(), [
'data' => ArrayHelper::map($tipeWilayah::find()->all(), 'id', 'nama'),
'options' => ['placeholder' => 'Tipe Wilayah'],
'pluginOptions' => [
'allowClear' => true
],
])->label('');
?>		
		</div>
		<div class="col-md-2" style="padding-right:5px;">
						<?php
$wilayah= new \common\models\Wilayah();
echo $form->field($wilayah, 'nama')->widget(DepDrop::classname(), [
'type' => DepDrop::TYPE_SELECT2,
'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
'pluginOptions'=>[
'depends'=>['tipewilayah-nama'],
'url' => Url::to(['/site/child-wilayah']),
'loadingText' => 'Loading Wilayah...',
'placeholder' => 'Nama Wilayah'
]
])->label('');

?>

		</div>
		<div class="col-md-2" style="padding-right:5px;">
		<?php
$topik= new \common\models\Topik();
echo $form->field($topik, 'nama')->widget(DepDrop::classname(), [
//  'data'=> ['selected'=>'Bank'],

'type' => DepDrop::TYPE_SELECT2,
'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
'pluginOptions'=>[
'depends'=>['wilayah-nama'],
'url' => Url::to(['/site/child-topik']),
'loadingText' => 'Loading Topik..',
'placeholder' => 'Topik'
]
])->label('');
?>
		</div>
		<div class="col-md-2" style="padding-right:5px;">
				<?php
$variabel= new \common\models\Variabel();
echo $form->field($variabel, 'nama')->widget(DepDrop::classname(), [
//  'data'=> ['selected'=>'Bank'],

'type' => DepDrop::TYPE_SELECT2,
'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
'pluginOptions'=>[
'depends'=>['topik-nama'],
'url' => Url::to(['/site/child-variabel']),
'loadingText' => 'Loading Variabel ...',
'placeholder' => 'Variabel'
]
])->label('');
?>
		</div>
		<div class="col-md-2" style="padding-right:5px;">
				<?php
$kategori= new \common\models\Kategori();
echo $form->field($kategori, 'nama')->widget(DepDrop::classname(), [
'type' => DepDrop::TYPE_SELECT2,
'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
'pluginOptions'=>[
'depends'=>['variabel-nama'],
'url' => Url::to(['/site/child-kategori']),
'loadingText' => 'Loading kategori ...',
'placeholder' => 'Kategori'
]
])->label('');
?>
		</div>
		<div class="col-md-2" style="padding-right:5px;">
		<?php
		echo Html::button('<i class="glyphicon glyphicon-play"></i> Generate', ['onclick'=>'calldatabaru()','class'=>'btn btn-success btn-sm','style'=>'margin-top:22px']);
		?>
		</div>
		
		</div>
		</div></div>

				<div class="row">
		<div class="col-md-4" style="padding-right:5px;">
		
		<div class="panel panel-success" >
		<div class="panel-heading">Grafik</div>

  <div class="panel-body" ><?= $this->render('_tabel') ?></div>		
		</div>
</div>
<div class="col-md-8" style="padding-left:0;">

<div class="panel panel-success" style="margin-bottom: 5px;">
<div class="panel-heading"><div class="row">
		<div class="col-md-3" style="padding-right:5px;">Peta 
		</div>
		<div class="col-md-3" style="padding-right:5px;">
<?= $this->render('_tahun') ?>
</div>
<div class="col-md-3" style="padding-right:5px;">Peta 
		</div>
		<div class="col-md-3" style="padding-right:5px;">Peta 
		</div>
</div>
	</div>
  <div class="panel-body" style="position:relative;">
  <div id="map"></div>
  <div id="loadingmap" style="width:100%;position:absolute;bottom:48%"></div>
  <div id="legend" class="info legend" style="position:absolute;bottom:20px;left:20px;"></div>
<?= $this->render('_legend') ?>

		</div>
		</div>
		<?= $this->render('_statistik') ?>
		</div>
        </div>
        </div>

