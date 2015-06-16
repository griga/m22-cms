<?php
/** Created by griga at 27.04.2015 | 12:35.
 * 
 */

namespace app\components\assets\bower;


use yii\web\AssetBundle;

class AnimateCssAsset extends AssetBundle {

    public $sourcePath = '@bower/animate.css';
    public $css = [
        'animate.min.css',
    ];

    public function init()
    {
        parent::init();
        $this->publishOptions['beforeCopy'] = function ($from, $to) {
            if(is_dir($from)){

                return basename($from) !== 'source';
            } else {
                $name = basename($from);
                return $name !== 'Gruntfile.js';
            }

        };
    }



}