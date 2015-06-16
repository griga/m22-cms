<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\components\forms\ActiveForm;
use app\modules\content\models\TopMenu;

/* @var $this yii\web\View */
/* @var $model app\modules\content\models\TopMenu */

if ($model->isNewRecord) {
    $this->title = 'Create Menu Item';
    $this->params['breadcrumbs'][] = ['label' => 'Menu', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Update Menu Item: ' . ' ' . $model->title;
    $this->params['breadcrumbs'][] = ['label' => 'Menu', 'url' => ['index']];
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
        
        <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>
		
		<?= $form->field($model, 'enabled')->checkbox() ?>

        <?= $form->field($model, 'parent_id')->dropdownList(
            ArrayHelper::map(TopMenu::find()->all(), 'id', 'title'),
            ['prompt'=>'']

        ) ?>

        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
