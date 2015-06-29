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
?>
<div class="site-index">


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
<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Template Import</h3>
          <span class="label label-primary pull-right"><i class="fa fa-file-excel-o"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">
          <p>Silakan download tamplate untuk mengimport data ke database.</p>
          <input type="submit" value="Download" class="btn btn-danger"> 
        </div><!-- /.box-body -->
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
$script = <<< JS
$('#el').on('click', function(e) {
    $.ajax({
       url: '/site/download',
       data: {id: '<id>', 'other': '<other>'},
       success: function(data) {
           // process data
       }
    });
});
JS;
$this->registerJs($script);
?>


</div>
