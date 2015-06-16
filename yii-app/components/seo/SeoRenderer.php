<?php 

namespace app\components\seo;

use Yii;
use yii\base\Component;
use yii\helpers\Html;
use yii\helpers\Url;

use app\components\lang\Lang;

class SeoRenderer extends Component{

	private $model;
	private $config;
	private $view;

	public function init(){
		$this->config = Yii::$app->lang->getCurrentConfig();
		$this->view = Yii::$app->view;
	}

	public function setModel($model){
		$this->model = $model;
	}

	public function process(){
        $this->renderTitle();
        $this->renderDescription();
        $this->renderKeywords();
        $this->renderCanonical();
        $this->renderTranslationLinks();
        
	}

	private function renderTitle(){
		if ($this->model){
			$content = $this->model->title . $this->config['suffix'];
		} else {
			$content = $this->config['title'];
		}
		echo Html::tag('title', Html::encode($this->normalizeStr($content) )) . PHP_EOL;
	}

	private function renderDescription(){
		if ($this->model and !empty($this->model->seo_description)){
			$content = $this->model->seo_description;
		} else {
			$content = $this->config['description'];
		}
	   $this->view->registerMetaTag(['name' => 'description', 'content' => Html::encode($this->normalizeStr($content))]);
	}

	private function renderKeywords(){
		if ($this->model and !empty($this->model->seo_keywords)){
			$content = $this->model->seo_keywords;
		} else {
			$content = $this->config['keywords'];
		}
		$this->view->registerMetaTag(['name' => 'keywords', 'content' => Html::encode($this->normalizeStr($content))]);
	}

	private function renderCanonical(){
		if($this->model){
	       	$alias = ltrim($this->model->alias, '/');
        	$content = Yii::$app->getUrlManager()->getHostInfo() . '/' . $this->config['key'] . ($alias ? '/' . $alias : '');
        	$this->view->registerLinkTag(['rel' => 'canonical', 'href' => $content]);	
        }
	}

	private function renderTranslationLinks(){
		if($this->model){
			$translationKeys = explode(',' , $this->model->available_translations);
			$alias = ltrim($this->model->alias, '/');
			foreach ($translationKeys as $key) {
				if ($key !== $this->config['key']){
        			$content = Yii::$app->getUrlManager()->getHostInfo() . '/' . $key . ($alias ? '/' . $alias : '');
        			$this->view->registerLinkTag(['rel' => 'alternate', 'href' => $content, 'hreflang'=>$key]);				
				}
			}
		}
	}

	/**
     * @param string $str
     * @return string
     */
    private function normalizeStr($str)
    {
        $str = strip_tags($str);
        $str = trim(preg_replace('/[\s]+/is', ' ', $str));
        return $str;
    }

}