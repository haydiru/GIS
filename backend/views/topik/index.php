<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TopikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Topiks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topik-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Topik', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama',
            'keterangan:ntext',
            'id_parent',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
