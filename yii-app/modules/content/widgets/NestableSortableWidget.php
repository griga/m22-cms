<?php


namespace app\modules\content\widgets;


use yii\base\Widget;
use app\components\assets\bower\NestableAsset;

class NestableSortableWidget extends Widget{

	public $models;
	public $rearrangeAction;

	public $isParent = true;

	public function run(){
		$id = $this->id . '-nestable-sortable';
		if($this->isParent){
			$this->registerScript($id);
		}
		return $this->render('nestable-sortable', [
			'id'=>$id,
			'models'=>$this->models,
			'isParent'=>$this->isParent,
		]);
	}

	public function registerScript($id){

		NestableAsset::register(\Yii::$app->view);
		$js = <<<JS
var nestable = \$('#$id').nestable({});
nestable.on('change', function() {
    \$.post('{$this->rearrangeAction}', {
    	data: nestable.nestable('serialize')
    });
});
JS;
		\Yii::$app->view->registerJs($js);
	}

}