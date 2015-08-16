<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use kartik\widgets\FileInput;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
$this->title = 'Import Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
<h1><?= Html::encode($this->title) ?></h1>
<div class="panel panel-success">
  <div class="panel-heading">Panel heading without title</div>
  <div class="panel-body">

<?php 
 $form1=ActiveForm::begin([
    'method' => 'post',
    'action' => Url::toRoute('site/download'),
]);
 $topik= new \common\models\TipeWilayah();
echo $form1->field($topik, 'nama')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(\common\models\TipeWilayah::find()->all(), 'id', 'nama'),
	'options' => ['placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);

// Child level 1
$variabel= new \common\models\Wilayah();
echo $form1->field($variabel, 'nama')->widget(DepDrop::classname(), [
    'options' => ['placeholder' => 'Select ...'],
	'pluginEvents'=> [
"depdrop.change"=>"function(event, id, value) { console.log(value); }",
],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['tipewilayah-nama'],
        'url' => Url::to(['/site/child']),
        'loadingText' => 'Loading child level 1 ...',
    ]
]);

?>

<button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
<span class="glyphicon glyphicon-chevron-down"></span>
 
</button> Tamplate Excel 
<div class="collapse" id="collapseExample">
  <div class="well" style="width:60%">
              <p>Silakan download tamplate untuk mengimport data ke database.</p>
          <input type="submit" value="Download" class="btn btn-danger"> 
  </div>
</div>

<?php
ActiveForm::end();
$form = ActiveForm::begin(['id' => 'login-form-inline', 
        'type' => ActiveForm::TYPE_INLINE,'options' => ['enctype' => 'multipart/form-data']]); 
echo '<div class="panel panel-success">';
?>
<?= $form->field($model, 'file')->fileInput(['class' => 'btn btn-success']) ?>
<?php echo '<div class="pull-right">';?>
<?=Html::submitButton('<i class="glyphicon glyphicon-upload"></i> Upload', ['class'=>'btn btn-info','style'=>'height:36px'])?>
<?php
echo '</div></div>';
ActiveForm::end(); 

?>

</div>
</div>
</div>
