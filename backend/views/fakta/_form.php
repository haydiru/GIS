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

    <?= $form->field($model, 'id_bulan')->textInput() ?>

    <?= $form->field($model, 'id_wilayah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_variabel')->textInput() ?>

    <?= $form->field($model, 'id_item_kategori')->textInput() ?>

    <?= $form->field($model, 'id_sumber_data')->textInput() ?>

    <?= $form->field($model, 'nilai')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
