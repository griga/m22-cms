<?php

use yii\db\Schema;
use yii\db\Migration;

class m150527_192535_config extends Migration
{
    public function up()
    {
        $this->insert('{{%system_config}}',[
                'key'=>'contact_skype',
                'value'=>'Евгений (AVSYSTEMS)',
            ]);
    }

    public function down()
    {

    }
    
}
