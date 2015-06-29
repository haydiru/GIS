<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Fakta */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Faktas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fakta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tahun',
            'id_bulan',
            'id_wilayah',
            'id_variabel',
            'id_item_kategori',
            'id_sumber_data',
            'nilai',
        ],
    ]) ?>

</div>
