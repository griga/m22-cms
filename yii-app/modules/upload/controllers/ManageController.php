<?php
/** Created by griga at 23.04.2015 | 22:09.
 *
 */

namespace app\modules\upload\controllers;


use app\modules\admin\controllers\AdminProtoController;
use app\modules\upload\models\Upload;

use vova07\imperavi\actions\GetAction;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;



class ManageController extends AdminProtoController
{

    public function actions()
    {
        return [
            'redactor-images' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'options' => [
                    'basePath' => \Yii::getAlias('@webroot'),
                ],
                'url' => '/', // Directory URL address, where files are stored.
                'path' => \Yii::getAlias('@webroot') . '/uploads/redactor', // Or absolute path to directory where files are stored.
                'type' => GetAction::TYPE_IMAGES,
            ],
            'redactor-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => '/uploads/redactor/', // Directory URL address, where files are stored.
                'path' => \Yii::getAlias('@webroot') . '/uploads/redactor', // Or absolute path to directory where files are stored.
            ]
        ];
    }

    /**
     *
     */
    public function actionDropzone()
    {
        if (Yii::$app->request->isPost) {
            $webroot = realpath(Yii::getAlias('@webroot'));
            $file = UploadedFile::getInstanceByName('file');
            $fileUrl = '/uploads/images/' . uniqid('pic') . '.' . $file->extension;
            $dirname = dirname($webroot . $fileUrl);
            if(!is_dir($dirname)){
                FileHelper::createDirectory($dirname);
            }
            $file->saveAs($webroot . $fileUrl);
            $upload = new Upload();
            $upload->url = $fileUrl;
            $upload->save();
            Yii::$app->response->format = 'json';
            return [
                'uploadId' => $upload->id,
            ];
        }
    }

    /**
     *
     */
    public function actionDropzoneDelete()
    {
        $req = Yii::$app->request;
        Yii::$app->response->format = 'json';
        if ($req->isPost) {
            $upload =Upload::find()->where(['id' => $req->post('uploadId')])->one();
            if($upload and $upload->delete()){
                return [
                    'id'=>$req->post('uploadId'),
                    'message'=>'Successful Deletion',
                ];
            }
        }
    }

}