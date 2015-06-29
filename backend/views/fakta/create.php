<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Fakta */

$this->title = 'Create Fakta';
$this->params['breadcrumbs'][] = ['label' => 'Faktas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fakta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
