<?php


use app\components\assets\AdminAsset;
use yii\helpers\Html;


/* @var $this \yii\web\View */
/* @var $content string */

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?= $this->render('@app/modules/main/views/shared/favicon') ?>
    <base href="/admin/"/>
    <?php $this->head() ?>

</head>

<?= $content ?>

<?= $this->render('@app/modules/main/views/shared/old-ie') ?>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage() ?>
