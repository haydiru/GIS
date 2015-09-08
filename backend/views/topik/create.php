<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Topik */

$this->title = 'Create Topik';
$this->params['breadcrumbs'][] = ['label' => 'Topiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
