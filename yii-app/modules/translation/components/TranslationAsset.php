<?php 

namespace app\modules\translation\components;

use yii\web\AssetBundle;

class TranslationAsset extends AssetBundle {

    public $sourcePath = '@app/modules/translation/assets';
    public $js = [
        'js/translation-app.js',
    ];
    public $css = [
        'css/translation.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public $publishOptions = [
        'forceCopy'=>true,
    ];

    public function init()
    {
        parent::init();
        $this->depends[] = \Yii::$app->getModule('translation')->angularAssetClass;
        
        $this->publishOptions['beforeCopy'] = function ($from, $to) {
            if(is_dir($from)){
                $dirname = basename($from);
            } else {
                $dirname = basename(dirname($from));
            }
            return in_array($dirname, ['css', 'js']);
        };
    }
}
