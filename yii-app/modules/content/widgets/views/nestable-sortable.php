<?php 
	use app\modules\content\widgets\NestableSortableWidget;
	use yii\helpers\Html;

 ?>
<?php if($isParent): ?>
<div class="dd" id="<?= $id?>">
<?php endif; ?>
    <ol class="dd-list">
		<?php foreach($models as $i => $model): ?>
        	<li class="dd-item" data-id="<?= $model->id ?>">

            	<div class="dd-handle"><?= $model->title ?>
            	</div>
            		<div class="dd-actions">
						
						<?= Html::a('<i class="fa fa-lg fa-edit"></i>', ['update', 'id'=>$model->id]) ?>
						<?= Html::a('<i class="fa fa-lg fa-trash"></i>', 
							['delete', 'id'=>$model->id], 
							[
								'data-method' => 'post',
								'data-confirm' => 'Are you sure you want to delete this item?',
							]) ?>
					</div>
            	<?php if(count($model->children)): ?>
					<?= NestableSortableWidget::widget([
						'models'=>$model->children,
						'isParent'=>false
					])?>
            	<?php endif; ?>
        	</li>
		<?php endforeach; ?>
    </ol>
<?php if($isParent): ?>
</div>
<?php endif; ?>
