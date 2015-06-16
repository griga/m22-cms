<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\components\forms;

use Yii;
use yii\base\Component;
use yii\base\ErrorHandler;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\base\Model;
use yii\web\JsExpression;
use yii\web\View;
use app\components\lang\Lang;


/**
 * ActiveField represents a form input field within an [[ActiveForm]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ActiveField extends \yii\widgets\ActiveField
{


    /**
     * Renders a text input.
     * This method will generate the "name" and "value" tag attributes automatically for the model attribute
     * unless they are explicitly specified in `$options`.
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
     *
     * The following special options are recognized:
     *
     * - maxlength: integer|boolean, when `maxlength` is set true and the model attribute is validated
     *   by a string validator, the `maxlength` option will take the value of [[\yii\validators\StringValidator::max]].
     *   This is available since version 2.0.3.
     *
     * Note that if you set a custom `id` for the input element, you may need to adjust the value of [[selectors]] accordingly.
     *
     * @return static the field object itself
     */
    public function multilingualTextInput($options = [])
    {
        $options = array_merge($this->inputOptions, $options);
        $this->adjustLabelFor($options);
        $content = '';
        foreach (Yii::$app->lang->getLanguages() as $langKey => $langTitle) {
            $htmlOptions = $options;
            $htmlOptions['data-ml-language'] = $langTitle;
            if ($langKey != Yii::$app->lang->get()){
                $htmlOptions['class'] .= ' hidden';
                $attributeName = $this->attribute . '_' . $langKey;
            } else {
                $attributeName = $this->attribute;
            }

            $content .= Html::activeTextInput($this->model, $attributeName , $htmlOptions);
        }
        $groupName = str_replace('\\','',get_class($this->model) . '_' . $this->attribute . '_' . 'multilang');
        $content = Html::tag('div',$content, [
            'data-ml-group' => $groupName,
            'class'=>'ml-group-wrapper',
        ]);

        $this->parts['{input}'] = $content;

        Yii::$app->view->registerJs('$.fn.m22Multilang.register(\'[data-ml-group="' . $groupName . '"]\')', View::POS_READY);

        return $this;
    }

    /**
     * Renders a text area.
     * The model attribute value will be used as the content in the textarea.
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
     *
     * If you set a custom `id` for the textarea element, you may need to adjust the [[$selectors]] accordingly.
     *
     * @return static the field object itself
     */
    public function multilingualTextarea($options = [])
    {
        $options = array_merge($this->inputOptions, $options);
        $this->adjustLabelFor($options);
        $content = '';
        foreach (Yii::$app->lang->getLanguages() as $langKey => $langTitle) {
            $htmlOptions = $options;
            $htmlOptions['data-ml-language'] = $langTitle;
            if ($langKey != Yii::$app->lang->get()){
                $htmlOptions['class'] .= ' hidden';
                $attributeName = $this->attribute . '_' . $langKey;
            } else {
                $attributeName = $this->attribute;
            }

            $content .= Html::activeTextarea($this->model, $attributeName , $htmlOptions);
        }
        $groupName = str_replace('\\','',get_class($this->model) . '_' . $this->attribute . '_' . 'multilang');
        $content = Html::tag('div',$content, [
            'data-ml-group' => $groupName,
            'class'=>'ml-group-wrapper',
        ]);

        $this->parts['{input}'] = $content;

        Yii::$app->view->registerJs('$.fn.m22Multilang.register(\'[data-ml-group="' . $groupName . '"]\')', View::POS_READY);

        return $this;
    }

    /**
     * Renders a checkbox.
     * This method will generate the "checked" tag attribute according to the model attribute value.
     * @param array $options the tag options in terms of name-value pairs. The following options are specially handled:
     *
     * - uncheck: string, the value associated with the uncheck state of the radio button. If not set,
     *   it will take the default value '0'. This method will render a hidden input so that if the radio button
     *   is not checked and is submitted, the value of this attribute will still be submitted to the server
     *   via the hidden input. If you do not want any hidden input, you should explicitly set this option as null.
     * - label: string, a label displayed next to the checkbox. It will NOT be HTML-encoded. Therefore you can pass
     *   in HTML code such as an image tag. If this is coming from end users, you should [[Html::encode()|encode]] it to prevent XSS attacks.
     *   When this option is specified, the checkbox will be enclosed by a label tag. If you do not want any label, you should
     *   explicitly set this option as null.
     * - labelOptions: array, the HTML attributes for the label tag. This is only used when the "label" option is specified.
     *
     * The rest of the options will be rendered as the attributes of the resulting tag. The values will
     * be HTML-encoded using [[Html::encode()]]. If a value is null, the corresponding attribute will not be rendered.
     *
     * If you set a custom `id` for the input element, you may need to adjust the [[$selectors]] accordingly.
     *
     * @param boolean $enclosedByLabel whether to enclose the checkbox within the label.
     * If true, the method will still use [[template]] to layout the checkbox and the error message
     * except that the checkbox is enclosed by the label tag.
     * @return static the field object itself
     */
    public function checkbox($options = [], $enclosedByLabel = true)
    {

        if($enclosedByLabel && $this->form->isHorizontal){
            $this->parts['{input}'] = Html::activeCheckbox($this->model, $this->attribute, $options);
            $this->parts['{label}'] = '<div class="col-md-2"></div>';

            $this->adjustLabelFor($options);
            return $this;
        } else {
            return parent::checkbox($options, $enclosedByLabel);
        }
    }





}
