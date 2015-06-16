<?php

namespace app\modules\main\controllers;


use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\main\models\ContactForm;
use app\modules\content\models\Page;
use app\modules\content\models\News;
use app\modules\admin\models\Notification;


class SiteController extends Controller
{
    public $layout = '@app/modules/main/views/layouts/main';


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {

        $model = $this->loadPage('/');

        return $this->render('index', [
                'model'=>$model,
            ]);
    }



    public function actionContact()
    {
        $formModel = new ContactForm();
        $model = $this->loadPage('contact');
        if ($formModel->load(Yii::$app->request->post()) && $formModel->validate()) {
            Notification::contactNotify($formModel->attributes);
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
                'formModel'=>$formModel,
            ]);
        }
    }


    public function actionPage($alias){
        $model = $this->loadPage($alias);
        return $this->render('page',[
            'model'=>$model,
        ]);
    }


    public function actionNews(){
        $models = News::find()->enabled()->all();

        $model = $this->loadPage('news');
        
        return $this->render('news',[
            'model'=>$model,
            'models'=>$models,
        ]);
    }


    public function actionNewsItem($alias){
        
        $model = News::find()->with('image')->where(['alias'=>$alias])->one();

        var_dump('yo');
        
        if(!$model){
             throw new NotFoundHttpException('The requested page does not exist.');
        } else {

            Yii::$app->seoRenderer->setModel($model);
            return $this->render('news-item',[
                'model'=>$model,
            ]);

        }
    }

    private function loadPage($alias){
        $model = Page::find()->with('image')->where(['alias'=>$alias])->one();
        
        if(!$model){
             throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            Yii::$app->seoRenderer->setModel($model);
            return $model;
        }
    }

}
