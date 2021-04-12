<?php

namespace common\models\material\inherit;


use common\models\material\Group;
use yii\db\ActiveQuery;
use zabachok\behaviors\SluggableBehavior;
/**
 * @property ActiveQuery|Group $parent
 * @property string $title
 * @property int $group_id
 */
abstract class Common extends \yii\db\ActiveRecord
{
    const SCENARIO_EDIT = 'edit';
    protected $copy = null;

    protected static $statuses = [
        '0' => 'Отключено',
        '10' => 'Включено',
        '100' => 'Обязательно',
    ];

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_EDIT] = ['sort', 'status'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => ['title'],
                'ensureUnique' => true,
                'uniqueValidator' => ['targetAttribute' => ['slug', 'group_id']]
            ],
        ];
    }

    /**
     * @param int $parentId
     * @return mixed
     */
    public abstract function toCopy($parentId);

    /**
     * @param bool $full
     * @return array
     */
    public static function getStatuses($full = false)
    {
        $statuses = self::$statuses;
        if (!$full) {
            unset($statuses[100]);
        }
        return $statuses;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'title' => 'Название',
            'group_id' => 'Group ID',
            'sort' => 'Порядок сортировки',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery|Group
     */
    public function getParent() {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    public function setCopy($copy) {
        $this->copy = $copy;
    }

    /**
     * @param null $params
     * @return Common|int
     */
    protected function getSortValue($params = null)
    {
        if (!$params) {
            $params = ['group_id' => $this->parent ? $this->parent->id : 0];
        }
        /** @var self $query */
        $query = self::find()->andWhere($params)->max('sort');
        if ($query == null) return 0;
        return ($query >= 0) ? ($query >= 0 ? $query+10 : 0) : 0;
    }
}
