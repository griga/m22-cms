<?php

/**
 * Class ModuleController
 *
 * @property $module TranslationModule
 */

namespace app\modules\translation\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;

class ModuleController extends Controller
{

    public $layout;

    public function init()
    {
        $this->layout = $this->module->layout;

        parent::init();
    }

    public function behaviors(){
        return $this->module->controllerBehaviors;
    }


    public function actionIndex()
    {
        return $this->render('index', [
                'baseUrl'=>$this->module->baseUrl,
            ]);
    }

    public function actionSave()
    {
        $request_body = Yii::$app->request->getRawBody();
        
        $data = Json::decode($request_body, true);
        if (isset($data['phrase'])) {
            Yii::$app->response->format='json';
            return $this->module->translation->save($data['phrase']);
        }
    }

    public function actionDelete()
    {
        $request_body = Yii::$app->request->getRawBody();

        $data = Json::decode($request_body, true);
        if (isset($data['phrase'])) {
            Yii::$app->response->format='json';
            return $this->module->translation->delete($data['phrase']);
        }
    }

    /**
     *
     */
    public function actionAll()
    {
        \Yii::$app->response->format = 'json';
        return $this->module->translation->getTranslationData();
    }

}