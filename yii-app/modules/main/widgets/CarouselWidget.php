<?php

namespace app\modules\main\widgets;

use yii\base\Widget;
use app\modules\content\models\Slide;

class CarouselWidget extends Widget {

	public $models;

	public function init(){
		if (!isset($this->models)){
			$this->models = Slide::find()->with('image')->multilingual()->where(['enabled'=>1])->all();
		}
	}

	public function run(){
		return $this->render('carousel', [
				'models'=>$this->models,
				'id'=>$this->getId() . '-carousel'
			]);
	}

}