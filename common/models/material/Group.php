<?php

namespace common\models\material;

use common\components\Common;
use common\models\material\inherit\Common as CommonModel;
use Yii;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;

/**
 * @property int $id
 * @property int $group_id
 * @property string $slug
 * @property string $title
 * @property int $type
 * @property int $sort
 * @property int $status
 * @property ActiveQuery|Group[] $groups
 * @property ActiveQuery|Field[] $fields
 * @property ActiveQuery|Material[] $materials
 * @property ActiveQuery|Material $material
 * @property ActiveQuery|GroupConfig $config
 */
class Group extends CommonModel
{
    private $totallyDelete = null;
    public $is_require = 0;
    public $is_config = 0;

    private static $types = [
        '0' => 'Поля',
        '100' => 'Материалы',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%group}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'slug', 'title', 'type'], 'required'],
            [['group_id', 'type', 'sort', 'status', 'is_require', 'is_config'], 'integer'],
            [['slug', 'title'], 'string', 'max' => 255],
            [['sort'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => 10],
            [['type'], 'in', 'range' => function () {
                return array_keys(self::$types);
            }]
        ];
    }

    public function attributeLabels()
    {

        return array_merge([
            'type' => 'Тип',
            'is_require' => 'Запретить удаление',
            'is_config' => 'Только один элемент',
        ], parent::attributeLabels());
    }

    /**
     * @return ActiveQuery
     */
    public function getConfig() {
        return $this->hasOne(GroupConfig::className(), ['group_id' => 'id']);
    }

    /**
     * @return ActiveQuery|Material
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::className(), ['group_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['group_id' => 'id'])
            ->orderBy(['sort' => SORT_ASC]);
    }

    /**
     * @return ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['group_id' => 'id'])
            ->orderBy(['sort' => SORT_ASC]);
    }

    /**
     * @return ActiveQuery
     */
    public function getFields()
    {
        return $this->hasMany(Field::className(), ['group_id' => 'id'])
            ->orderBy(['sort' => SORT_ASC]);
    }

    /**
     * @return array
     */
    public static function getTypes()
    {
        return self::$types;
    }

    /**
     * @param $id
     * @return Group|null
     * @throws NotFoundHttpException
     */
    public function findParent($id)
    {
        if ($model = self::findOne($id)) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

    /**
     * {@inheritdoc}
     */
    public function toCopy($parentId)
    {
        $model = new self();
        $model->attributes = $this->attributes;
        $model->id = null;
        $model->group_id = $parentId;
        $model->setCopy($this->id);
        if ($model->save()) {
            return true;
        }
        return false;
    }

    /**
     * @param Material|Group $parent
     * @return bool
     */
    public static function createBasicGroups($parent)
    {
        $model = new self();
        $model->title = 'Основное';
        $model->type = 0;
        $model->status = 100;
        $model->group_id = $parent->id;
        if ($model->save()) {
            return Field::createBasicFields($model);
        }
        return false;
    }

    protected function findBasicChild() {
        return self::findOne(['group_id' => $this->id, 'status' => 100]);
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->sort = $this->getSortValue();
        }
        if ($this->getScenario() != self::SCENARIO_EDIT) {
            if ($this->id) {
                $model = $this->findBasicChild();
                if ($this->type == 100 && !$model) {
                    if (!Group::createBasicGroups($this)) {
                        throw new NotFoundHttpException();
                    }
                    Common::deleteAll($this->fields, true);
                } else if ($this->type != 100 && $model) {
                    $model->delete(true);
                }
            }
            if ($this->is_require) {
                $this->status = 100;
            } else if ($this->status == 100 && !$this->parent) {
                $this->status = 10;
            }
        } else {
            $model = self::findOne($this->id);
            if ($this->parent && $model->status == 100 && $this->status != $model->status) {
                return false;
            }
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function beforeDelete()
    {
        if ($this->status == 100 && !$this->totallyDelete) {
            Yii::$app->session->setFlash('danger', 'Не удалось удалить некторые элементы (Они являются обязательными).');
            return false;
        }
        Common::deleteAll($this->fields, true);
        Common::deleteAll($this->groups, true);
        Common::deleteAll($this->materials);
        /** @var GroupConfig $model */
        if ($model = $this->config) {
            $model->delete();
        }
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    /**
     * @param bool $totally
     * @return false|int
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function delete($totally = false)
    {
        $this->totallyDelete = $totally;
        return parent::delete(); // TODO: Change the autogenerated stub
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($this->getScenario() != self::SCENARIO_EDIT) {
            if ($this->is_config && !$this->config) {
                $model = new GroupConfig();
                $model->group_id = $this->id;
                $model->save();
            } else if (!$this->is_config && $model = $this->config) {
                /** @var GroupConfig $model */
                $model->delete();
            }
        }
        if ($insert && !$this->copy) {
            if ($this->type == 100) {
                if (!Group::createBasicGroups($this)) {
                    throw new NotFoundHttpException();
                }
            }
        }
        if ($this->copy) {
            $model = self::findOne($this->copy);
            /** @var Group $group */
            foreach ($model->groups as $group) {
                $group->toCopy($this->id);
            }
            /** @var Field $field */
            foreach ($model->fields as $field) {
                $field->toCopy($this->id);
            }
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}
