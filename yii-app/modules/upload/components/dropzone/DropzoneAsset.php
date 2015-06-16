<?php
/** Created by griga at 19.04.2015 | 11:29.
 *
 */

namespace app\modules\upload\components\dropzone;

use yii\web\AssetBundle;

class DropzoneAsset extends AssetBundle {

    public $sourcePath = '@app/modules/upload/components/dropzone/assets';
    public $js = [
        'js/dropzone.js',
    ];
    public $css = [
        'css/dropzone.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
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
            return in_array($dirname, ['css', 'js']);
        };
    }


}