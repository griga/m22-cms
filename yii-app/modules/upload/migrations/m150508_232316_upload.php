<?php

use yii\db\Schema;
use yii\db\Migration;

class m150508_232316_upload extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%upload}}', [
            'id' => 'pk',
            'url'=>'string NOT NULL',
            'sort'=>'integer',
            'meta' => 'text',
            'created_by' => 'integer NOT NULL',
            'updated_by' => 'integer NOT NULL',
            'created_at' => 'integer NOT NULL',
            'updated_at' => 'integer NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%upload}}');
    }

}
