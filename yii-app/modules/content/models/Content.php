<?php

namespace app\modules\content\models;

use app\components\lang\Lang;
use app\components\models\ActiveRecord;
use app\modules\upload\models\Upload;
use app\modules\sitemap\behaviors\SitemapBehavior;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use Yii;
use yii\helpers\Url;


/**
 * This is the model class for table "{{%content}}".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $enabled
 * @property integer $type
 * @property integer $parent_id
 * @property integer $image_id
 * @property integer $sort
 * @property integer $publish_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Content extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enabled', 'type', 'parent_id', 'image_id', 'sort', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['alias'], 'string', 'max' => 255],
            [['available_translations'], 'string', 'max' => 100],
            ['publish_date', 'date', 'format' => 'yyyy-M-d H:m:s'],
            [$this->getMultilingualAttributes(),'safe'
                ,'on'=>self::SCENARIO_MULTILINGUAL_UPDATE
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Alias',
            'enabled' => 'Enabled',
            'type' => 'Type',
            'parent_id' => 'Parent',
            'image_id' => 'Image',
            'sort' => 'Sort',
            'publish_date' => 'Publish Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            'blameable' => [
                'class' => 'yii\behaviors\BlameableBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],
                ],
            ],
            'ml' => [
                'class' => MultilingualBehavior::className(),
                'languages' => Yii::$app->lang->getLanguages(),
                'defaultLanguage' => Yii::$app->params['defaultLanguage'],
                'langForeignKey' => 'entity_id',
                'tableName' => "{{%content_lang}}",
                'attributes' => [
                    'title', 'content', 'short_content', 'seo_keywords', 'seo_description'
                ]
            ],
            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    $model->select(['alias', 'updated_at', 'type', 'available_translations']);
                    $model->andWhere(['enabled' => 1]);
                },
                'dataClosure' => function ($model) {
                    $out = [];
                    $translations = explode(',', $model->available_translations);
                    $alias = ltrim($model->alias, '/');
                    foreach ($translations as $key) {
                        $url = Yii::$app->getUrlManager()->getHostInfo() . '/' . $key . ($alias ? '/' . $alias : '');
                        $data = [
                           'loc' => $url,
                           'lastmod' => $model->updated_at,
                           'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                           'priority' => 0.8,
                           'translations' => [],
                        ];
                        foreach ($translations as $translationKey) {
                            $data['translations'][$translationKey] = Yii::$app->getUrlManager()->getHostInfo() . '/' . $translationKey . ($alias ? '/' . $alias : '');
                        }
                        $out[]=$data;
                    }
                    return $out;
                }
            ],
       ];
    }

    public function fields()
    {
        return array_merge($this->getMultilingualAttributes(),
            ['id']);
    }

    public function getMultilingualAttributes(){
        $result = [];
        /** @var MultilingualBehavior $ml */
        if(isset($this->behaviors()['ml'])){
            $ml = $this->behaviors()['ml'];
            foreach($ml['languages'] as $lang=>$langName){
                foreach($ml['attributes'] as $attr)
                    if($ml['defaultLanguage'] === $lang)
                        $result[] = $attr;
                    else
                        $result[] = $attr . '_' . $lang;
            }
        }
        return $result;
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }



    /**
     * We're overriding this method to fill findAll() and similar method result
     * with proper models.
     *
     * @param array $row
     * @return Content
     */

    public static function instantiate($row)
    {
        switch ($row['type']){
            case Page::TYPE:
                return new Page();
            case Slide::TYPE:
                return new Slide();
            case TopMenu::TYPE:
                return new TopMenu();
            case News::TYPE:
                return new News();
            default:
                return new self;
        }
    }

    public function getImage(){
        return $this->hasOne(Upload::className(), ['id'=>'image_id']);
    }

    public function getChildren(){
        return $this->hasMany(self::className(), ['parent_id'=>'id'])->sorted();
    }

    public function beforeSave($insert){
        $languages = Yii::$app->lang->getLanguages();
        $defaultLanguage = Yii::$app->params['defaultLanguage'];

        foreach ($languages as $key => $language) {
            $contentAttributeName = ($key === $defaultLanguage ? 'content' : 'content_'.$key);
            $shortContentAttributeName = ($key === $defaultLanguage ? 'short_content' : 'short_content_'.$key);
            
            if(preg_match('~<hr class="content-cut">~s', $this->{$contentAttributeName})){
                $this->{$shortContentAttributeName} =  preg_replace('~<hr class="content-cut">.+~s', '', $this->{$contentAttributeName});
            }

        }   

        return parent::beforeSave($insert);
    }




}
