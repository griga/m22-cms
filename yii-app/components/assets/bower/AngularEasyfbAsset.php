<?php
/** Created by griga at 27.04.2015 | 12:35.
 * 
 */

namespace app\components\assets\bower;


use yii\web\AssetBundle;

class AngularEasyfbAsset extends AssetBundle {

    public $sourcePath = '@bower/angular-easyfb';
    public $js = [
        'angular-easyfb.js',
    ];

}