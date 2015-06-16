<?php
/** Created by griga at 22.04.2015 | 5:49.
 * 
 */

namespace app\modules\content\models;


use omgdef\multilingual\MultilingualTrait;
use yii\db\ActiveQuery;

class ContentQuery extends ActiveQuery {

    use MultilingualTrait;

    public $type;

    public function prepare($builder){
        if($this->type !== null){
            $this->andWhere(['type'=>$this->type]);
        }


        return parent::prepare($builder);
    }

    public function sorted()
    {
        return $this->orderBy('sort ASC');
    }

    public function enabled()
    {
        return $this->andWhere(['enabled'=>1]);
    }

}