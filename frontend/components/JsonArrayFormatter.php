<?php
namespace app\components;
use Yii;
use yii\web\ResponseFormatterInterface;
use yii\base\Component;
use yii\helpers\Json;

class JsonArrayFormatter implements ResponseFormatterInterface
{
    public function format($response)
    { $response->getHeaders()->set('Content-Type', 'application/json; charset=UTF-8');
        if ($response->data !== null) {
            $response->content ="{\"data\" : " . Json::encode($response->data)."}";
	//		$fp = fopen("data.json","w");
	//		fwrite($fp,$response->content);
	//		fclose($fp);
        }
    }
}