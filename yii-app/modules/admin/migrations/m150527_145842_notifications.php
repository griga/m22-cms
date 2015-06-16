<?php

use yii\db\Schema;
use yii\db\Migration;

class m150527_145842_notifications extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%system_notification}}',[
                'id'=>'pk',
                'subject'=>'string',
                'email'=>'string',
                'name'=>'string',
                'phone'=>'string',
                'body'=>'string',
                'to'=>'string',
                'status'=>'smallint DEFAULT 0',
                'readed'=>'smallint DEFAULT 0',
                'sended'=>'smallint DEFAULT 0',
                'sended_at'=>'integer DEFAULT NULL',
                'created_at' => 'integer NOT NULL',
                'updated_at' => 'integer NOT NULL',

            ], $tableOptions);
    }   

    public function down()
    {
        
        // $this->dropTable('{{%system_notification}}');
    }
    
}
