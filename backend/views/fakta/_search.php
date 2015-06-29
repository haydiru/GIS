<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FaktaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fakta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'id_bulan') ?>

    <?= $form->field($model, 'id_wilayah') ?>

    <?= $form->field($model, 'id_variabel') ?>

    <?php // echo $form->field($model, 'id_item_kategori') ?>

    <?php // echo $form->field($model, 'id_sumber_data') ?>

    <?php // echo $form->field($model, 'nilai') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
