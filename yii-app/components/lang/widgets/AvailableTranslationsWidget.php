<?php 

namespace app\components\lang\widgets;

use Yii;
use yii\helpers\Html;
use yii\widgets\InputWidget;
use app\components\lang\Lang;

class AvailableTranslationsWidget extends InputWidget
{
	public function run(){

		$id = Html::getInputId($this->model, $this->attribute);
		$selected = explode(',', $this->model->{$this->attribute});
		
		$content = Html::beginTag('div', [
				'class'=>'m22-available-translations-container',
			]);

		$content .= Html::activeHiddenInput($this->model, $this->attribute, [
				'id'=>$id,
			]);

		foreach (Yii::$app->lang->getLanguages() as $key => $title) {
			$content .= Html::checkbox($this->attribute . '_' . $key, in_array($key, $selected) , [
				'label'=>$title,
				'class'=>'m22-available-translations-checkbox',
				'value'=>$key
				]);
			$content .= '<br>';
		}
		$content .= Html::endTag('div');

		$js = <<< JS
		\$('.m22-available-translations-container').on('click', '.m22-available-translations-checkbox', function(){
			var translations = [];
			\$('.m22-available-translations-checkbox:checked').each(function(){
				translations.push(\$(this).val());
			})
			\$('#$id').val(translations.join(','));
		});
JS;

		Yii::$app->view->registerJs($js);
		return $content;
	}
}