<?php

class m140628_091652_system extends yii\db\Migration
{
	public function up()
	{
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%system_config}}',[
            'id'=>'pk',
            'key'=>'VARCHAR(255) NOT NULL',
            'value'=>'VARCHAR(255) NOT NULL',
        ], $tableOptions);

        $this->insert('{{%system_config}}',[
            'key'=>'site_email_address',
            'value'=>'noreply@allprojectors.com',
        ]);

        $this->insert('{{%system_config}}',[
            'key'=>'site_email_from',
            'value'=>'Allprojectors',
        ]);

        $this->insert('{{%system_config}}',[
            'key'=>'order_notify_emails',
            'value'=>'grigach@gmail.com',
        ]);


        $this->createTable('{{%system_template}}',[
            'id'=>'pk',
            'key'=>'VARCHAR(128) NOT NULL',
            'comment'=>'TEXT',
        ], $tableOptions);


        $this->createTable('{{%system_template_lang}}',[
            'id' => 'pk',
            'entity_id' => 'integer NOT NULL', //'INT NOT NULL',
            'language' => 'VARCHAR(6) NOT NULL',
            'name' => 'VARCHAR(255) ',
            'content' => 'TEXT',
        ], $tableOptions);
        $this->createIndex('stl_ei', '{{%system_template_lang}}', 'entity_id');
        $this->createIndex('stl_li', '{{%system_template_lang}}', 'language');

       

        $this->addForeignKey('stl_ibfk_1', '{{%system_template_lang}}', 'entity_id', '{{%system_template}}', 'id', 'CASCADE', 'CASCADE');


    }

	public function down()
	{
        $this->dropTable('{{%system_template_lang}}');
        $this->dropTable('{{%system_template}}');
        $this->dropTable('{{%system_config}}');
	}

}