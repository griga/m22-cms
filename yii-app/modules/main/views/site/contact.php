<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $formModel app\modules\main\models\ContactForm */

?>

<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

    <div class="alert alert-success">
        <?= Yii::t('site','Thank you for contacting us. We will respond to you as soon as possible.')?>
    </div>

<?php endif ?>

<?php if($model->image): ?>
    <?= EasyThumbnailImage::thumbnailImg(
   '@webroot' . $model->image->url,
    1300, 200,
    EasyThumbnailImage::THUMBNAIL_OUTBOUND, [
     'alt' => $model->title,
     'class'=>'img-responsive', ]); ?> 
<?php endif ?>

 <div class="content-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <?= $model->content ?>
            </div>
        </div>

        <?php if (!Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <?= $form->field($formModel, 'name') ?>
                    <?= $form->field($formModel, 'email') ?>
                    <?= $form->field($formModel, 'subject') ?>
                    <?= $form->field($formModel, 'body')->textArea(['rows' => 6]) ?>
                    <?= $form->field($formModel, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-sm-3">{image}</div><div class="col-sm-6">{input}</div></div>',
                    ]) ?>
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('site', 'Submit'), ['class' => 'btn btn-primary btn-lg', 'name' => 'contact-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        <?php endif; ?>

    </div>
</div>
