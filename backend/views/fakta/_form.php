<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Fakta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fakta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tahun')->textInput() ?>

	<?= $form->field($model, 'id_bulan')->dropDownList(
      \yii\helpers\ArrayHelper::map(\common\models\Bulan::find()->all(), 'id', 'nama'))->label('Bulan') ?>

    <?= $form->field($model, 'id_wilayah')->dropDownList(
      \yii\helpers\ArrayHelper::map(\common\models\Wilayah::find()->all(), 'id', 'nama'))->label('Wilayah') ?>

    <?= $form->field($model, 'kode_unik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_variabel')->dropDownList(
      \yii\helpers\ArrayHelper::map(\common\models\Variabel::find()->all(), 'id', 'nama'))->label('Variabel') ?>

    <?= $form->field($model, 'id_kategori')->dropDownList(
      \yii\helpers\ArrayHelper::map(\common\models\Kategori::find()->all(), 'id', 'nama'))->label('Kategori') ?>

    <?= $form->field($model, 'id_item_kategori')->dropDownList(
      \yii\helpers\ArrayHelper::map(\common\models\ItemKategori::find()->all(), 'id', 'nama'))->label('tem Kategori') ?>

    <?= $form->field($model, 'id_sumber_data')->dropDownList(
      \yii\helpers\ArrayHelper::map(\common\models\SumberData::find()->all(), 'id', 'nama_cs'))->label('Sumber Data') ?>

    <?= $form->field($model, 'nilai')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
