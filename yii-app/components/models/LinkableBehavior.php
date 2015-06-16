<?php 


namespace app\components\models;

use Yii;
use yii\base\Behavior;
use yii\helpers\Html;


class LinkableBehavior extends Behavior{

	public $textAttribute = 'title';
    public $urlAttribute = 'alias';
    public $urlPath;
    public $urlRule;

    private function getUrl(){
        if(is_string($this->urlRule)){
            $model = $this->owner;
            return @eval($this->urlRule);
        } else if(is_callable($this->urlRule)){
            return call_user_func_array($this->urlRule, [$this->owner]);
        } else {
            return $this->urlPath . ($this->owner->{$this->urlAttribute} ?: $this->owner->primaryKey) ;
        }
    }

    private function getText(){
    	return $this->owner{$this->textAttribute};
    }


	public function getLink($options = []){
		return Html::a($this->getText(), $this->getUrl(), $options);
	}

	public function getTitledLink($title, $options = []){
		return Html::a($title, $this->getUrl(), $options);	
	}

	public function getReadMoreLink($options = []){
		return Html::a(Yii::t('core', 'Read More'), $this->getUrl(), $options);	
	}

}