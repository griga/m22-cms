<?php
/** Created by griga at 27.04.2015 | 12:35.
 * 
 */

namespace app\components\assets\bower;


use yii\web\AssetBundle;

class JsCookieAsset extends AssetBundle {

    public $sourcePath = '@bower/js-cookie/src';
    public $js = [
        'js.cookie.js',
    ];

}