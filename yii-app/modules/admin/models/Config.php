<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "{{%system_config}}".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%system_config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['key', 'value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'value' => 'Value',
        ];
    }

    private static $configCache;
    private static function getCache(){
        if(!isset(self::$configCache)){
            self::$configCache = [];
            foreach( (new Query())->select('*')->from('{{%system_config}}')->all() as $item){
                self::$configCache[$item['key']] = $item['value'];
            }
        }
        return self::$configCache;
    }


    public static function get($key){
        $config = self::getCache();
        if(isset($config[$key]))
            return $config[$key];
        if(isset(Yii::$app->params[$key]))
            return Yii::$app->params[$key];
        if(strpos($key,'.') !== false){
            $split = explode('.', $key);
            return self::getRecursiveParam(Yii::$app->params[array_shift($split)], $split);
        }
        return null;
    }

    private static function getRecursiveParam($parent, $child){
        if(count($child)==1)
            return $parent[array_shift($child)];
        else if(count($child)>1)
            return self::getRecursiveParam($parent[array_shift($child)], $child);
        else
            return null;
    }

}
