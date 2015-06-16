<?php

namespace app\modules\content\controllers;

use app\modules\admin\controllers\AdminCrudController;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends AdminCrudController
{
    public $modelClass = 'app\modules\content\models\Page';
    public $modelSearchClass = 'app\modules\content\models\ContentSearch';
    public $useViewAction = false;
    public $useMultilingual = true;

}
