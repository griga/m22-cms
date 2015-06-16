<?php
/** Created by griga at 27.04.2015 | 12:35.
 * 
 */

namespace app\components\assets\bower;


use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle {

    public $sourcePath = '@bower/font-awesome';
    public $css = [
        'css/font-awesome.min.css',
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
            return $dirname === 'fonts' || $dirname === 'css';
        };
    }



}