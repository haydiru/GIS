<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GeoserverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Geoserver Urls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geoserver-url-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Geoserver Url', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_wilayah',
            'url:ntext',
            'zoom',
            'center_x',
            // 'center_y',
            // 'tipe',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
