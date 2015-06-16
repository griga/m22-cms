<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%system_notification}}".
 *
 * @property integer $id
 * @property string $subject
 * @property string $email
 * @property string $name
 * @property string $phone
 * @property string $body
 * @property string $to
 * @property integer $status
 * @property integer $readed
 * @property integer $sended
 * @property integer $sended_at
 * @property integer $created_at
 * @property integer $updated_at
 */
class Notification extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%system_notification}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'readed', 'sended', 'sended_at', 'created_at', 'updated_at'], 'integer'],
            [['subject', 'email', 'name', 'phone', 'body', 'to'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'Subject',
            'email' => 'Email',
            'name' => 'Name',
            'phone' => 'Phone',
            'body' => 'Body',
            'to' => 'To',
            'status' => 'Status',
            'readed' => 'Readed',
            'sended' => 'Sended',
            'sended_at' => 'Sended At',
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
        ];
    }

    public static function contactNotify($data){
            
        foreach( explode(',' , Config::get('order_notify_emails')) as $email){
            self::sendMail($email, $data['email'], $data['name'], $data['subject'], $data['body']);

            $notification = new Notification([
                    'subject'=>$data['subject'],
                    'email'=>$data['email'],
                    'name'=>$data['name'],
                    'body'=>$data['body'],
                    'to'=>$email,
                    'sended'=>1,
                    'sended_at'=>date('U'),
                ]);    
        }
    }

    public static function sendMail($to, $from, $name, $subject, $body){
        Yii::$app->mailer->compose()
            ->setTo($to)
            ->setFrom([$from => $name])
            ->setSubject($subject)
            ->setTextBody($body)
            ->send();
    }
}
