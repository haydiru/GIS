<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VariabelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Variabels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="variabel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Variabel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_topik',
            'nama',
            'keterangan:ntext',
            'satuan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
