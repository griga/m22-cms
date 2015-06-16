<?php
/** Created by griga at 21.04.2015 | 14:14.
 * 
 */

namespace app\modules\admin\controllers;


use app\components\auth\filters\AdminAccessRule;
use yii\filters\AccessControl;
use yii\web\Controller;

class AdminProtoController extends Controller {

    public $layout = '@app/modules/admin/views/layouts/one-column';
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AdminAccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

}