<?php
/** Created by griga at 27.04.2015 | 12:35.
 * 
 */

namespace app\components\assets\bower;


use yii\web\AssetBundle;

class AngularAsset extends AssetBundle {

    public $sourcePath = '@bower/angular';
    public $js = [
        'angular.js',
    ];

}