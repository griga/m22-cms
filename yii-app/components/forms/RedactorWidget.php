<?php
/** Created by griga at 09.05.2015 | 0:39.
 *
 */

namespace app\components\forms;

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use Yii;
use yii\web\View;
use yii\helpers\ArrayHelper;
use vova07\imperavi\Widget;

use app\components\lang\Lang;

class RedactorWidget extends InputWidget
{

    public function getDefaultSettings()
    {
        $settings = [
            
            'imageUpload' => '/upload/manage/redactor-upload',
            'imageGetJson' => '/upload/manage/redactor-images',
            'minHeight' => 700,
            'paragraphize'=>false,
            'replaceDivs'=>false,
            'plugins' => [
                'fullscreen',
            ]
        ];
        if (Yii::$app->lang->get() !== 'en')
            $settings['lang'] = Yii::$app->lang->get() == 'uk' ? 'ua' : Yii::$app->lang->get();
        return $settings;
    }

    /**
     * @var array {@link http://imperavi.com/redactor/docs/ redactor options}.
     */
    public $settings = [];

    public $plugins = [
        'cut'=> 'app\components\forms\redactorAssets\RedactorCutAsset'
    ];

    public $css = [];


    public function run()
    {
        $settings = ArrayHelper::merge($this->getDefaultSettings(), $this->settings);

        $content = '';
        foreach (Yii::$app->lang->getLanguages() as $langKey => $langTitle) {
            $htmlOptions = ['class' => ''];
            $htmlOptions['data-ml-language'] = $langTitle;
            if ($langKey != Yii::$app->lang->get()) {
                $htmlOptions['class'] .= ' hidden';
                $attributeName = $this->attribute . '_' . $langKey;
            } else {
                $attributeName = $this->attribute;
            }

            $content .= Html::tag('div', Widget::widget([
                'model' => $this->model,
                'attribute' => $attributeName,
                'settings' => $settings,
                'plugins'=> $this->plugins,
            ]),
                $htmlOptions);

        }
        $groupName = str_replace('\\', '', get_class($this->model) . '_' . $this->attribute . '_' . 'multilang');
        $content = Html::tag('div', $content, [
            'data-ml-group' => $groupName,
            'class' => 'ml-group-wrapper',
        ]);

        Yii::$app->view->registerJs('$.fn.m22Multilang.register(\'[data-ml-group="' . $groupName . '"]\')', View::POS_READY);
        foreach ($this->css as $style=>$options) {
            Yii::$app->view->registerCssFile($style, $options);
        }
        
        return $content;
    }


}