<?php

namespace app\modules\content\controllers;

use app\modules\admin\controllers\AdminCrudController;


class SlideController extends AdminCrudController
{
    public $modelClass = 'app\modules\content\models\Slide';

    public $modelSearchClass = 'app\modules\content\models\ContentSearch';
    public $useViewAction = false;
    public $useMultilingual = true;
}
