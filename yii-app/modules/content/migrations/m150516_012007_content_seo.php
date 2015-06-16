<?php

use yii\db\Schema;
use yii\db\Migration;

class m150516_012007_content_seo extends Migration
{
    public function up()
    {
        $this->addColumn('{{%content}}', 'available_translations', 'string(100)');
        $this->addColumn('{{%content_lang}}', 'seo_keywords', 'string');
        $this->addColumn('{{%content_lang}}', 'seo_description', 'string');

    }

    public function down()
    {
       $this->dropColumn('{{%content}}', 'available_translations');
       $this->dropColumn('{{%content_lang}}', 'seo_keywords');
       $this->dropColumn('{{%content_lang}}', 'seo_description'); 
    }
    
}
