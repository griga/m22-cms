<?php
/** Created by griga at 19.04.2015 | 11:29.
 *
 */

namespace app\components\forms\redactorAssets;
use yii\web\AssetBundle;
class RedactorCutAsset extends AssetBundle {
    public $sourcePath = '@app/components/forms/redactorAssets/assets';
    public $js = [
        'cut.js',
    ];
    public $publishOptions = [
    	'forceCopy'=>true,
    ];
}