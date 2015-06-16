<?php

namespace app\modules\upload\models;

use Yii;
use yii\db\ActiveRecord;

use himiklab\thumbnail\EasyThumbnailImage;

/**
 * This is the model class for table "{{%upload}}".
 *
 * @property integer $id
 * @property string $url
 * @property integer $sort
 * @property string $meta
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Upload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%upload}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['sort', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['meta'], 'string'],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'sort' => 'Sort',
            'meta' => 'Meta',
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
        ];

    }

    public function getUploadInfo()
    {
        $filePath = Yii::getAlias('@webroot') . $this->url;
        return [
            'url' => EasyThumbnailImage::thumbnailFileUrl('@webroot'. $this->url, 200, 100, EasyThumbnailImage::THUMBNAIL_INSET),
            'type' => mime_content_type($filePath),
            'name' => basename($filePath),
            'size' => filesize($filePath),
            'uploadId' => $this->id,
        ];
    }

    public function afterDelete()
    {
        $filePath = Yii::getAlias('@webroot') . $this->url;

        $splFile = new \SplFileInfo($filePath);
        $extension = pathinfo($splFile->getFilename(), PATHINFO_EXTENSION);
        if ($splFile->isFile()) {
            unlink($splFile->getRealPath());
            // $originalFile = Yii::$app->params['dataDir'] . '/' . ltrim($this->url, '/');
            // if (is_file($originalFile)) {
                // unlink($originalFile);
            // }
        }

        return parent::afterDelete();
    }

    public function afterSave($insert, $changedAttributes)
    {
        // $webroot = realpath(Yii::getAlias('@webroot'));
        // $dataroot = Yii::$app->params['dataDir'];
        // if ($webroot !== $dataroot) {
            // $dirname = dirname($dataroot . $this->url);
            // if (!is_dir($dirname)) {
                // mkdir($dirname, 0755, true);
            // }
            // copy($webroot . $this->url, $dataroot . $this->url);
        // }

        return parent::afterSave($insert, $changedAttributes);
    }


}
