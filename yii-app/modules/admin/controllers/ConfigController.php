<?php

namespace app\modules\admin\controllers;



/**
 * ConfigController implements the CRUD actions for Config model.
 */
class ConfigController extends AdminCrudController
{
    public $modelClass = 'app\modules\admin\models\Config';
    public $modelSearchClass = 'app\modules\admin\models\ConfigSearch';
    public $useViewAction = false;

}
