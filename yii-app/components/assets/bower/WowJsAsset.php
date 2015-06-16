<?php
/** Created by griga at 27.04.2015 | 12:35.
 * 
 */

namespace app\components\assets\bower;


use yii\web\AssetBundle;

class WowJsAsset extends AssetBundle {

    public $sourcePath = '@bower/wow.js';
    public $js = [
        'dist/wow.min.js',
    ];

    public function init()
    {
        parent::init();
        $this->publishOptions['beforeCopy'] = function ($from, $to) {
            if(is_dir($from)){
                $dirname = basename($from);
            } else {
                $dirname = basename(dirname($from));
            }
            return $dirname === 'dist';
        };

        \Yii::$app->view->registerJs('new WOW().init();');
    }

}