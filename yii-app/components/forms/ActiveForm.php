<?php
/** Created by griga at 08.05.2015 | 22:49.
 *
 */

namespace app\components\forms;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use Yii;
use app\components\assets\bower\JsCookieAsset;


class ActiveForm extends \yii\widgets\ActiveForm
{

    /**
     * @var string the default field class name when calling [[field()]] to create a new field.
     * @see fieldConfig
     */
    public $fieldClass = 'app\components\forms\ActiveField';


    public $isHorizontal = false;

    /**
     * Initializes the widget.
     * This renders the form open tag.
     */
    public function init()
    {
        if (isset($this->options['class']) and strpos($this->options['class'], 'form-horizontal') !== FALSE) {
            $this->isHorizontal = true;
            $this->fieldConfig = function($model, $atttribute, $options){
                if(isset($options['inputColumnClass'])){
                    $inputColumnClass = $options['inputColumnClass'];
                } else {
                    $inputColumnClass = 'col-sm-10';
                }
                return ['template' => "{label}\n<div class=\"".$inputColumnClass."\">{input}</div>\n<div class=\"col-md-offset-2 col-md-10\">{error}</div>"];
            };
        }
        M22FormAsset::register(Yii::$app->view);
        parent::init();
    }


    /**
     * Generates a form field.
     * A form field is associated with a model and an attribute. It contains a label, an input and an error message
     * and use them to interact with end users to collect their inputs for the attribute.
     * @param Model $model the data model
     * @param string $attribute the attribute name or expression. See [[Html::getAttributeName()]] for the format
     * about attribute expression.
     * @param array $options the additional configurations for the field object
     * @return ActiveField the created ActiveField object
     * @see fieldConfig
     */
    public function field($model, $attribute, $options = [])
    {
        $config = $this->fieldConfig;
        if ($config instanceof \Closure) {
            $config = call_user_func($config, $model, $attribute, $options);
        }
        if (!isset($config['class'])) {
            $config['class'] = $this->fieldClass;
        }
        unset( $options['inputColumnClass']);
        if ($this->isHorizontal) {
            $options = array_merge($options,
                ['labelOptions' => ['class' => 'control-label col-md-2']]
                );
        }
        return Yii::createObject(ArrayHelper::merge($config, $options, [
            'model' => $model,
            'attribute' => $attribute,
            'form' => $this,
        ]));
    }


    public function beginSectionHider($options){
        $expanded = true;
        $id = 'm22Section';
        if($options['key']){
            $id .= $options['key']; 
            $cookieName  = $id . 'hidden';
            if(isset($_COOKIE[$cookieName])){
                $expanded = false;
            }         
            JsCookieAsset::register(\Yii::$app->view);
            $js = <<< JS
                var fieldset = \$('#$id');
                fieldset.on('click', 'legend', function(){
                    var expanded = $('fieldset').hasClass('expanded');
                    fieldset.toggleClass('expanded', !expanded);
                    fieldset.toggleClass('collapsed', expanded);
                    fieldset.find('legend i').toggleClass('fa-caret-down', !expanded);
                    fieldset.find('legend i').toggleClass('fa-caret-left', expanded);
                    if(expanded){
                        Cookies.set('$cookieName', true, {expires: 30, path: '/admin'});
                    } else {
                        Cookies.remove('$cookieName', { path: '/admin' })
                    }
                    
                })
JS;
            Yii::$app->view->registerJs($js);
        }
        return '<fieldset id="'.$id.'" class="m22-fieldset ' . ($expanded ? 'expanded' : 'collapsed' ) .'"><legend>'.$options['title'].'<i class="fa fa-fw fa-caret-' . ($expanded ? 'down' : 'left' ) .'"></i></legend>';
    }

    public function endSectionHider(){
        return '</fieldset>';
    }


}