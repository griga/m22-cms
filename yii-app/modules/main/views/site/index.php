<?php
/* @var $this yii\web\View */
use app\modules\main\widgets\CarouselWidget;

?>
<?= CarouselWidget::widget([
	'id'=>'main'
]) ?>

<?= $model->content ?>
