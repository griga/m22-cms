<?php
/** Created by griga at 18.06.2014 | 21:32.
 * 
 */
namespace app\modules\content\models;


use Yii;
use app\components\lang\Lang;

class TopMenu extends Content {

	const TYPE = 4;

	public static function find()
	{
		return new ContentQuery(get_called_class(), ['type'=>self::TYPE]);
	}

	public function beforeSave($insert){
		$this->type = self::TYPE;
		return parent::beforeSave($insert);
	}



	private static $recursiveCache;

	public static function frontEndItems(){
	

        if(!empty(self::$recursiveCache))
            return self::$recursiveCache;

        $activeUrl = '/'. ltrim(Yii::$app->request->pathInfo, '/');

        $model_sorter = function(&$models){
            usort($models, function($a, $b) {
                return $a['sort'] - $b['sort'];
            });
        };

        $get_label = function($model){
    		$default = '';
        	foreach ($model['translations'] as $translation) {
        		if($translation['language']==Yii::$app->lang->getDefault()){
        			$default = $translation['title'];
        		}
        		if($translation['language']==Yii::$app->lang->get() && trim($translation['title']) !== ''){
        			return $translation['title'];
        		}

        			
        	}
        	return $default;
        };

        $model_searcher = function(&$models, $rawData) use ($activeUrl, $get_label, $model_sorter, &$model_searcher){
            foreach($models as &$model){
                $url = '/'.Yii::$app->lang->get() . '/' . $model['alias'];
            	$model['label'] = $get_label($model);
                $model['url'] = $url;
            	$model['active'] = $url === $activeUrl;

                $model['items'] = array_filter($rawData, function($item) use ($model){
                    return $item['parent_id']==$model['id'];
                });
                if(count($model['items'])>0){
                    $model_sorter($model['items']);
                    $model_searcher($model['items'], $rawData);
                } else {
                	unset($model['items']);
                }
            }
        };


        $rawData = 	self::find()->enabled()->sorted()->multilingual()->asArray()->all();

        $models = array_filter($rawData, function($item){
            return !$item['parent_id'];
        });

        $model_sorter($models);
        $model_searcher($models, $rawData);

        self::$recursiveCache = $models;
        
        return $models;

	}


} 