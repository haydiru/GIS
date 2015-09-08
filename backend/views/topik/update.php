<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Topik */

$this->title = 'Update Topik: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Topiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="topik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
