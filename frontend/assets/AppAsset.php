<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
		'leaflet/leaflet.css',
		'leaflet/minimap/src/Control.MiniMap.css',
    ];
    public $js = [
	'jquery-layout/jquery.layout.js',
	'leaflet/leaflet-src.js',
	'leaflet/map.js',
	'leaflet/minimap/src/Control.MiniMap.js',
	'leaflet/provider/leaflet-providers.js',
	
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
