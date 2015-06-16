<?php

use yii\db\Schema;
use yii\db\Migration;

class m150526_100930_configs extends Migration
{
    public function up()
    {
        $this->insert('{{%system_config}}',[
                'key'=>'contact_phone',
                'value'=>'+38 000 0000 000',
            ]);
        $this->insert('{{%system_config}}',[
                'key'=>'contact_email',
                'value'=>'contact@avsystems.com.ua',
            ]);
    }

    public function down()
    {
    }
    
}
