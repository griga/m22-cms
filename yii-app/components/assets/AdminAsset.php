<?php
/** Created by griga at 19.04.2015 | 11:29.
 *
 */

namespace app\components\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/admin.css'
    ];

    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
        'app\components\assets\bower\FontAwesomeAsset',
    ];

}