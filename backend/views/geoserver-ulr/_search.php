<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GeoserverSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geoserver-url-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_wilayah') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'zoom') ?>

    <?= $form->field($model, 'center_x') ?>

    <?php // echo $form->field($model, 'center_y') ?>

    <?php // echo $form->field($model, 'tipe') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
