<?php

use yii\helpers\Html;
use app\components\forms\ActiveForm;
use app\modules\upload\components\dropzone\DropzoneWidget;
use app\modules\admin\models\Config;

/* @var $this yii\web\View */
/* @var $model app\modules\content\models\Page */

if ($model->isNewRecord) {
    $this->title = 'Create Page';
    $this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Update Page: ' . ' ' . $model->title;
    $this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
    $this->params['breadcrumbs'][] = 'Update';
}

?>
<div class="page-update">

    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <h1><?= Html::encode($this->title) ?></h1>
            <hr/>
        </div>
    </div>
    <div class="page-form">

        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal'],
        ]); ?>

        
        <?= $form->field($model, 'title')->multilingualTextInput(['maxlength' => 255]) ?>

        <!--        --><? //= $form->field($model, 'short_content')->multilingualTextarea(['rows' => 5]) ?>

              <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>


        <?= $form->field($model, 'image_id')->widget(DropzoneWidget::className(), [
            'existingFile'=>$model->image,
            'options'=>[
                'class'=>'col-md-3 col-sm-4 col-xs-6'
            ],
        ]) ?>



        <?= $form->field($model, 'content')->widget(app\components\forms\RedactorWidget::className(),[
            'css'=>[
                '@web/css/style-redactor.css' => [
                    'depends'=>[
                        'app\components\assets\bower\AnimateCssAsset',
                        'app\components\assets\bower\WowJsAsset'
                    ]
                ]
            ],
            
        ]) ?>

        
        <div class="row">
            <div class="col-sm-10 col-sm-offset-2">
                
                <?= $form->beginSectionHider([
                    'title'=>'Seo',
                    'key'=>'seo'
                ]) ?>

                <?= $form->field($model, 'seo_keywords')->multilingualTextarea() ?>
                
                <?= $form->field($model, 'seo_description')->multilingualTextarea() ?>

                <?= $form->field($model, 'available_translations')->widget(app\components\lang\widgets\AvailableTranslationsWidget::className()) ?>

                <?= $form->endSectionHider() ?>
            </div>
        </div>



        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
