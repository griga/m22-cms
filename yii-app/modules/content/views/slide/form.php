<?php

use yii\helpers\Html;
use app\components\forms\ActiveForm;
use app\modules\upload\components\dropzone\DropzoneWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\content\models\Page */

if ($model->isNewRecord) {
    $this->title = 'Create Slide';
    $this->params['breadcrumbs'][] = ['label' => 'Slides', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Update Slide: ' . ' ' . $model->id;
    $this->params['breadcrumbs'][] = ['label' => 'Slides', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
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
		
		<?= $form->field($model, 'enabled')->checkbox() ?>

        <?= $form->field($model, 'image_id')->widget(DropzoneWidget::className(), [
            'existingFile'=>$model->image,
            'options'=>[
                'class'=>'col-md-6'
            ],
        ]) ?>

        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
