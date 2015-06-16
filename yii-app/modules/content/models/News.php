<?php
/** Created by griga at 18.06.2014 | 21:32.
 * 
 */
namespace app\modules\content\models;

class News extends Content {

    const TYPE = 5;

    public static function find()
    {
        return new ContentQuery(get_called_class(), ['type'=>self::TYPE]);
    }

    public function beforeSave($insert){
        $this->type = self::TYPE;
        return parent::beforeSave($insert);
    }

    public function behaviors(){
    	return array_merge(parent::behaviors(),
    		[
    			'sluggable'=>[
    				'class'=> \yii\behaviors\SluggableBehavior::className(),
    				'slugAttribute'=>'alias',
    				'attribute'=>'title'
    			],   
                'linkable'=>[
                    'class'=>\app\components\models\LinkableBehavior::className(),
                    'urlPath'=>'/' . \Yii::$app->lang->get() . '/news/',
                ]
    		]);

    }
} 