<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GeoserverUrl */

$this->title = 'Create Geoserver Url';
$this->params['breadcrumbs'][] = ['label' => 'Geoserver Urls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geoserver-url-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
