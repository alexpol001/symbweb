<?php

namespace common\models\material\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\material\Group as GroupModel;

class Group extends GroupModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'sort', 'status', 'type'], 'integer'],
            [['slug', 'title'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = GroupModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder'=>['sort' => SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'group_id' => $this->group_id,
            'sort' => $this->sort,
            'status' => $this->status,
            'type' => $this->type
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
        ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

    /**
     * @param $parent
     */
    public function setParent($parent) {
        $this->group_id = $parent;
    }
}
