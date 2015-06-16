<?php

use yii\db\Schema;
use yii\db\Migration;

class m150527_141854_pages extends Migration
{
    public function up()
    {
        $this->delete('{{%content}}', 'alias="news" and type=1');
        $this->insert('{{%content}}', [
                'alias'=>'news',
                'type'=>1,
                'enabled'=>1,
                'created_by'=>1,
                'updated_by'=>1,
                'created_at'=>date('U'),
                'updated_at'=>date('U'),
                'available_translations'=>'ru,uk,en',
            ]);

        $pageId = $this->db->getLastInsertID();
        $this->insert('{{%content_lang}}',[
                'entity_id'=>$pageId,
                'language'=>'ru',
                'title'=>'Новости',
                'content'=>'<h1>Новости</h1><hr>',
            ]);
        $this->insert('{{%content_lang}}',[
                'entity_id'=>$pageId,
                'language'=>'en',
                'title'=>'News',
                'content'=>'<h1>News</h1><hr>',
            ]);
        $this->insert('{{%content_lang}}',[
                'entity_id'=>$pageId,
                'language'=>'uk',
                'title'=>'Новини',
                'content'=>'<h1>Новини</h1><hr>',
            ]);

        $this->delete('{{%content}}', 'alias="contacts" and type=1');
        $this->insert('{{%content}}', [
                'alias'=>'contact',
                'type'=>1,
                'enabled'=>1,
                'created_by'=>1,
                'updated_by'=>1,
                'created_at'=>date('U'),
                'updated_at'=>date('U'),
                'available_translations'=>'ru,uk,en',
            ]);

        $pageId = $this->db->getLastInsertID();
        $this->insert('{{%content_lang}}',[
                'entity_id'=>$pageId,
                'language'=>'ru',
                'title'=>'Контакты',
                'content'=>'<h1>Контакты</h1><hr>',
            ]);
        $this->insert('{{%content_lang}}',[
                'entity_id'=>$pageId,
                'language'=>'en',
                'title'=>'Contacts',
                'content'=>'<h1>Contacts</h1><hr>',
            ]);
        $this->insert('{{%content_lang}}',[
                'entity_id'=>$pageId,
                'language'=>'uk',
                'title'=>'Контакти',
                'content'=>'<h1>Контакти</h1><hr>',
            ]);


    }

    public function down()
    {
       
    }
    
}
