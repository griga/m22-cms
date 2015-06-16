<?php
use yii\db\Schema;


class m150101_225937_content extends yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%content}}', [
            'id' => 'pk', //'pk',
            'alias' => 'string',//'VARCHAR(255)',
            'enabled' => 'boolean NOT NULL DEFAULT 1', //'TINYINT NOT NULL DEFAULT 1',
            'type' => 'smallint NOT NULL', //'TINYINT NOT NULL',
            'parent_id' => 'integer DEFAULT 0', //'INT NULL DEFAULT NULL',
            'image_id' => 'integer',//'INT',
            'sort' => 'integer',//'INT NULL DEFAULT NULL',
            'publish_date' => 'datetime', //'DATETIME NULL DEFAULT NULL',
            'created_by' => 'integer NOT NULL',//'INT',
            'updated_by' => 'integer NOT NULL',//'INT',
            'created_at' => 'integer NOT NULL',
            'updated_at' => 'integer NOT NULL',
        ], $tableOptions);


        $this->createTable('{{%content_lang}}', [
            'id' => 'pk', //'pk',
            'entity_id' => 'integer NOT NULL', //'INT NOT NULL',
            'language' => 'VARCHAR(6) NOT NULL',
            'title' => 'string',
            'content' => 'text',
            'short_content' => 'text',
        ], $tableOptions);
        $this->createIndex('c_ei', '{{%content_lang}}', 'entity_id');
        $this->createIndex('c_li', '{{%content_lang}}', 'language');

        $this->addForeignKey('c_ibfk_1', '{{%content_lang}}', 'entity_id', '{{%content}}', 'id', 'CASCADE', 'CASCADE');


    }

    public function down()
    {
        $this->dropForeignKey('c_ibfk_1', '{{%content_lang}}');
        $this->dropTable('{{%content_lang}}');

        $this->dropTable('{{%content}}');
    }

}