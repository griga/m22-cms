<?php

namespace app\modules\translation;

use Yii;
use app\modules\translation\components\Translation;

class Module extends yii\base\Module
{

    public $controllerNamespace = 'app\modules\translation\controllers';

    public $controllerBehaviors = [];

    public $angularAssetClass;

    /**
     * @property string the base url for module.
     */
    public $baseUrl = '/translation/module';

    /**
     * @property array the list of languages 'shortCode'=>'label' ('en'=>'English')
     */
    public $languages = [];

    /**
     * @property string source language in messages files
     */
    public $sourceLanguage;

    /**
     * @property Translation operator object
     */
    public $translation;

    public $mapping;

    /**
     * @property boolean whether to enable debug mode.
     */
    public $debug = false;

    public function init()
	{
        parent::init();

        $this->translation = new Translation();
	}


}
