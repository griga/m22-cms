<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use app\components\models\ActiveRecord;

/**
 * PageController implements the CRUD actions for Page model.
 */
class AdminCrudController extends AdminProtoController
{
    public $modelClass;
    public $modelSearchClass;

    public $useViewAction = true;
    public $useMultilingual = false;

    public function init()
    {
        if (!$this->modelClass) {
            throw new HttpException(500, '$modelClass not specified');
        }
        if (!$this->modelSearchClass) {
            throw new HttpException(500, '$modelSearchClass not specified');
        }
        return parent::init();
    }


    public function behaviors()
    {
        return array_merge(parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post'],
                    ],
                ],
            ]);
    }

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $class = $this->modelSearchClass;
        $searchModel = new $class();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Page model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if($this->useViewAction){
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $class = $this->modelClass;
        $model = new $class;

        if($this->useMultilingual){
            $model->scenario = ActiveRecord::SCENARIO_MULTILINGUAL_UPDATE;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($this->useMultilingual){
            $model->scenario = ActiveRecord::SCENARIO_MULTILINGUAL_UPDATE;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $class = $this->modelClass;
        if($this->useMultilingual){
            $model = $class::find()->multilingual()->where(['id' => $id])->one();
        } else {
            $model = $class::find()->where(['id' => $id])->one();
        }
        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
