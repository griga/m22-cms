<?php
/** Created by griga at 19.04.2015 | 11:29.
 *
 */

namespace app\components\forms;

use yii\web\AssetBundle;

class M22FormAsset extends AssetBundle {

    public $sourcePath = '@app/components/forms/assets';
    public $js = [
        'm22-forms.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

}