<?php
/** Created by griga at 18.06.2014 | 21:32.
 * 
 */
namespace app\modules\content\models;

class Page extends Content {

    const TYPE = 1;

    public static function find()
    {
        return new ContentQuery(get_called_class(), ['type'=>self::TYPE]);
    }

    public function beforeSave($insert){
        $this->type = self::TYPE;
        return parent::beforeSave($insert);
    }
} 