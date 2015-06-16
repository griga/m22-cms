<?php

namespace app\modules\upload\components\dropzone;

use yii\widgets\InputWidget;
use Yii;
use yii\web\View;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Json;

class DropzoneWidget extends InputWidget
{

    public $multiple = false;

    public $existingFile;
    public $existingFiles;

    public $settings;


    public $defaults = [
        'url' => '/admin/upload/manage/dropzone',
        'removeUrl' => '/admin/upload/manage/dropzone-delete',
        'addRemoveLinks' => true,
        'maxFiles' => 1,
    ];

    public function run()
    {
        $inputId = Html::getInputId($this->model, $this->attribute);
        $dropzoneId = $inputId . '-dropzone-widget';
        $out = Html::activeHiddenInput($this->model, $this->attribute);

        $out .= Html::tag('div', '', [
            'id' => $dropzoneId,
            'class' => 'dropzone ' . (isset($this->options['class']) ? $this->options['class'] : '')
        ]);

        $this->registerJs($inputId, $dropzoneId);
        return $out;
    }

    public function registerJs($inputId, $dropzoneId)
    {
        $settings = $this->defaults;
        $request = Yii::$app->request;
        if ($request->enableCsrfValidation) {
            $settings['params'] = [
                $request->csrfParam => $request->getCsrfToken(),
            ];
        }

        $successCallback = <<< JS
        function (file, data){
            if (data.uploadId) {
                file.uploadId = data.uploadId;
                $('#$inputId').val(data.uploadId);
            }
        }
JS;
        $settings['success'] = new JsExpression($successCallback);

        $removeCallback = <<< JS
        function (file){
            if(confirm('Are you sure want to remove file?')){
                if(file.uploadId){
                    $.post('{$settings['removeUrl']}', {
                        uploadId:file.uploadId
                    }).success(function(data){
                        if($('#$inputId').val() == data.id){
                           $('#$inputId').val('');
                        }
                    })
                }
                if (file.previewElement && file.previewElement.parentNode) {
                    file.previewElement.parentNode.removeChild(file.previewElement);
                }
                return this._updateMaxFilesReachedClass();
            } else {
                return false;
            }


        }
JS;
        $settings['removedfile'] = new JsExpression($removeCallback);

        $existingFiles = [];
        if($this->existingFile){
            $existingFiles = [$this->existingFile->uploadInfo];
        }
        $encodedExistingFiles = Json::encode($existingFiles);

        $encodedConfig = Json::encode($settings);
        $init = <<< JS
        Dropzone.autoDiscover = false;
        var dz = new Dropzone("#$dropzoneId", $encodedConfig);
        var files = $encodedExistingFiles;
        files.forEach(function(file){
            dz.emit("addedfile", file);
            dz.emit("thumbnail", file, file.url);
            dz.emit("complete", file);
        })
        dz.options.maxFiles = dz.options.maxFiles - files.length;
JS;
        DropzoneAsset::register(Yii::$app->view);
        Yii::$app->view->registerJS($init);


    }
}