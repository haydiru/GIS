<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FaktaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Faktas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fakta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fakta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php 
$wilayah = \yii\helpers\ArrayHelper::map(
\common\models\Wilayah::find()->all(),
'id', 'nama');


?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'id_wilayah',
			['attribute'=>'id_wilayah',
	            'label'=>'Wilayah',
	            'format'=>'text',//raw, html
	            'content'=>function($data){
	                return $data->getParentName();}
					],
            'tahun',
            'id_bulan',
            'id_variabel',
            'id_item_kategori',
            'nilai',
            'id_sumber_data',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
