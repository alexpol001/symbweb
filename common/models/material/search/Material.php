<?php

namespace common\models\material\search;

use common\models\material\MaterialField;
use DateTime;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\material\Material as MaterialModel;
use yii\db\ActiveQuery;

class Material extends MaterialModel
{
    public $fields;
    public $material;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'material_id', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
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
        $this->fields = $params['field'];
        $query = MaterialModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['sort' => SORT_ASC]]
        ]);

        $this->load($params);

        $this->searchFieldFilter($query);
        if ($this->material) {
            $query->andWhere(['=', 'sw_material.material_id', $this->material]);
        }

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'group_id' => $this->group_id,
            'material_id' => $this->material_id,
            'sort' => $this->sort,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

    /**
     * @param int $parent
     * @param int $material
     */
    public function setParent($parent, $material = null)
    {
        $this->group_id = $parent;
        if ($material) {
            $this->material = $material;
        }
    }

    /**
     * @param ActiveQuery $query
     */
    protected function searchFieldFilter($query) {
        if ($this->fields) {
            $materials = MaterialModel::find()->andWhere(['group_id' => $this->group_id]);
            if ($this->material) {
                $materials->andWhere(['material_id' => $this->material]);
            }
            $materials = $materials->all();
            foreach ($this->fields as $key => $value) {
                if ($value != '') {
                    /** @var Material $model */
                    foreach ($materials as $i => $model) {
                        if ($fieldValue = $model->getValue($key)) {
                            $field = \common\models\material\Field::findOne($key);
                            switch ($field->type) {
                                case 400:
                                case 1000:
                                    if ($fieldValue != $value) {
                                        $query->andWhere(['<>', 'sw_material.id', $model->id]);
                                    }
                                    break;
                                case 500:
                                    if (!in_array($value, explode(", ", $fieldValue))) {
                                        $query->andWhere(['<>', 'sw_material.id', $model->id]);
                                    }
                                    break;
                                case 1100:
                                    $dates = explode(", ", $fieldValue);
                                    $date1 = DateTime::createFromFormat('!d/m/Y', $dates[0])->getTimestamp();
                                    $date2 = DateTime::createFromFormat('!d/m/Y', $dates[1])->getTimestamp();
                                    $searchDate = DateTime::createFromFormat('!d/m/Y', $value)->getTimestamp();
                                    if ($date1 > $searchDate || $date2 < $searchDate) {
                                        $query->andWhere(['<>', 'sw_material.id', $model->id]);
                                    }
                                    break;
                                default:
                                    if (stripos(mb_strtolower($fieldValue), mb_strtolower($value)) === false) {
                                        $query->andWhere(['<>', 'sw_material.id', $model->id]);
                                    }
                            }
                        } else {
                            $query->andWhere(['<>', 'sw_material.id', $model->id]);
                        }
                    }
                }
            }
        }
    }
}
