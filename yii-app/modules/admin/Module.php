<?php

namespace app\modules\admin;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public $defaultRoute = 'dashboard/index';

    public function init()
    {
        parent::init();



        // custom initialization code goes here
    }
}