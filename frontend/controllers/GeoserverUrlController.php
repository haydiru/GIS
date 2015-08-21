<?php

namespace frontend\controllers;
use yii\helpers\Json;
use yii\web\Response;
use common\models\GeoserverUrl;
use yii\filters\VerbFilter;

class GeoserverUrlController extends \yii\web\Controller
{
	    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionLoadPeta($idWil)
    {
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$model = GeoserverUrl::findOne(['id_wilayah' => $idWil,]);
		  $peta=file_get_contents($model->url);
		return $peta;
    }
	public function beforeAction($action) {
		$this->enableCsrfValidation = false; // <-- here
		return parent::beforeAction($action);
	}
}
