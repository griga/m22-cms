<?php

use yii\helpers\Html;
use app\components\forms\ActiveForm;
use app\modules\upload\components\dropzone\DropzoneWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\content\models\Page */

if ($model->isNewRecord) {
    $this->title = 'Create Config';
    $this->params['breadcrumbs'][] = ['label' => 'Parameters', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Update Config: ' . ' ' . $model->key;
    $this->params['breadcrumbs'][] = ['label' => 'Parameters', 'url' => ['index']];
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

        <?= $form->field($model, 'key')->textArea(['maxlength' => 255]) ?>
        <?= $form->field($model, 'value')->textArea(['maxlength' => 255]) ?>
		
		<div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
