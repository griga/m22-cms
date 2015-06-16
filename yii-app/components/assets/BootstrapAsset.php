<?php
/** Created by griga at 19.04.2015 | 11:29.
 *
 */

namespace app\components\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css',
        '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
        'css/ae-bootstrap-theme.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    public $js = [
    ];

}