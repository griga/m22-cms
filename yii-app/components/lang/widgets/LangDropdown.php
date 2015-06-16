<?php

namespace app\components\lang\widgets;

use \yii\base\widget;

class LangDropdown extends Widget{
	
	public function run(){
		return $this->render('lang-dropdown');
	}
}