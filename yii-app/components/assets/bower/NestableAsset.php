<?php
/** Created by griga at 27.04.2015 | 12:35.
 * 
 */

namespace app\components\assets\bower;


use yii\web\AssetBundle;

class NestableAsset extends AssetBundle {

    public $sourcePath = '@bower/nestable';
    public $js = [
        'jquery.nestable.js',
    ];
	
	public $depends  = [
		'yii\jui\JuiAsset',
	];


}