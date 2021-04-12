<?php

namespace common\models\material;

/**
 * @property int $id
 * @property int $material_id
 * @property int $field_id
 * @property string $value
 */
class MaterialField extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%material_field}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['material_id', 'field_id'], 'required'],
            [['material_id', 'field_id'], 'integer'],
            [['value'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'material_id' => 'Material ID',
            'field_id' => 'Field ID',
            'value' => 'Value',
        ];
    }

    /**
     * @param Material $material
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public static function saveFields($material)
    {
        $data = $material->PostData;
        if (!$data['field']) return;
        foreach ($data['field'] as $key => $value) {
                $model = self::findOne(['material_id' => $material->id, 'field_id' => $key]);
                if (!$model) {
                    $model = new self();
                    $model->material_id = $material->id;
                    $model->field_id = $key;
                }
                $field = Field::findOne($key);
                if ($field->type == 500 || $field->type == 1100) {
                    $value = self::parseMultiValue($value);
                }
                $model->value = $value;
                $model->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function toCopy($parentId)
    {
        $model = new self();
        $model->attributes = $this->attributes;
        $model->id = null;
        $model->material_id = $parentId;
        if ($model->save()) {
            return true;
        }
        return false;
    }

    /**
     * @param $value
     * @return string
     */
    protected static function parseMultiValue($value)
    {
        $val = '';
        foreach ($value as $i => $item) {
            if ($i != 0) {
                $val .= ', ';
            }
            $val .= $item;
        }
        return $val;
    }
}
