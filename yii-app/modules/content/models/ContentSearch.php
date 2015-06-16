<?php

namespace app\modules\content\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\content\models\Page;

/**
 * ContentSearch represents the model behind the search form about `app\modules\content\models\Page`.
 */
class ContentSearch extends Content
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'enabled', 'type', 'parent_id', 'image_id', 'sort', 'publish_date', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['alias'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Content::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'enabled' => $this->enabled,
//            'type' => $this->type,
            'parent_id' => $this->parent_id,
            'image_id' => $this->image_id,
            'sort' => $this->sort,
            'publish_date' => $this->publish_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $modelClass = Yii::$app->controller->modelClass;
        $query->andWhere(['type'=>$modelClass::TYPE]);

        $query->andFilterWhere(['like', 'alias', $this->alias]);

        return $dataProvider;
    }
}
