<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FaktaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Faktas';
$this->params['breadcrumbs'][] = $this->title;

$wilayah = \yii\helpers\ArrayHelper::map(
\common\models\Wilayah::find()->all(),
'id', 'nama');
$bulan = \yii\helpers\ArrayHelper::map(
\common\models\Bulan::find()->all(),
'id', 'nama');
$variabel = \yii\helpers\ArrayHelper::map(
\common\models\Variabel::find()->all(),
'id', 'nama');
$kategori = \yii\helpers\ArrayHelper::map(
\common\models\Kategori::find()->all(),
'id', 'nama');
$sumberData = \yii\helpers\ArrayHelper::map(
\common\models\SumberData::find()->all(),
'id', 'nama_cs');


?>
<div class="fakta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fakta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
				'filter'=>$wilayah,
	            'content'=>function($data){
	                return $data->getParentNameWilayah();}
					],
					
            'tahun',
            ['attribute'=>'id_bulan',
	            'label'=>'Bulan',
	            'format'=>'text',//raw, html
				'filter'=>$bulan,
	            'content'=>function($data){
	                return $data->getParentNameBulan();}
					],
              ['attribute'=>'id_variabel',
	            'label'=>'Variabel',
	            'format'=>'text',//raw, html
				'filter'=>$variabel,
	            'content'=>function($data){
	                return $data->getParentNameVariabel();}
					],
            ['attribute'=>'id_kategori',
	            'label'=>'Kategori',
	            'format'=>'text',//raw, html
				'filter'=>$kategori,
	            'content'=>function($data){
	                return $data->getParentNameKategori();}
					],
            'nilai',
            ['attribute'=>'id_sumber_data',
	            'label'=>'Sumber Data',
	            'format'=>'text',//raw, html
				'filter'=>$sumberData,
	            'content'=>function($data){
	                return $data->getParentNameSumberData();}
					],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
