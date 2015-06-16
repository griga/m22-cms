<?php
/** Created by griga at 05.05.2015 | 12:15.
 * 
 */

namespace app\modules\admin\controllers;


class DashboardController extends AdminProtoController {


    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    /**
     *
     */
    public function actionIndex()
    {

        return $this->render('index', [
            'breadcrumbs'=>['Dashboard']
        ]);
    }

}