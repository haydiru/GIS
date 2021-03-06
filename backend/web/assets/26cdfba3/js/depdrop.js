/*!
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-widgets
 * @subpackage yii2-widget-depdrop
 * @version 1.0.1
 *
 * Extensions to dependent dropdown for Yii:
 * - Initializes dependent dropdown for Select2 widget
 * 
 * For more JQuery plugins visit http://plugins.krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */
var initDepdropS2 = function (id, text) {
    (function ($) {
        "use strict";
        var $s2 = $('#' + id), $s2cont = $('#select2-' + id + '-container'), ph = '...';
        $s2.on('depdrop.beforeChange', function () {
            $s2.find('option').attr('value', ph).html(text);
            $s2.select2('val', ph);
            $s2cont.removeClass('kv-loading').addClass('kv-loading');
        }).on('depdrop.change', function () {
            $s2.select2('val', $s2.val());
            $s2cont.removeClass('kv-loading');
        });
    }(window.jQuery));
};