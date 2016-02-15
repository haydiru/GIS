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
		'leaflet/easyPrint.css',
		'leaflet/minimap/src/Control.MiniMap.css',
    ];
    public $js = [
	'geostats-master/lib/geostats.js',
	'leaflet/leaflet-src.js',
	'leaflet/saveSvgAsPng.js',
	'leaflet/canvg.js',
	'leaflet/rgbcolor.js',
	'leaflet/map.js',
	'leaflet/leaflet.easyPrint.js',
	'leaflet/grafiksapu.js',
	'leaflet/minimap/src/Control.MiniMap.js',
	'leaflet/provider/leaflet-providers.js',
	'chartjs/Chart.min.js',
	'highcharts/js/highcharts.js',
	'highcharts/js/modules/exporting.js',
	'highcharts/js/modules/drilldown.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
