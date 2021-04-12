<?php
namespace common\components;


use common\models\material\Field;
use common\models\material\Group;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Common extends \yii\base\Component
{

    /**
     * @param $array ActiveQuery|array
     * @param null $totallyDelete
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public static function deleteAll($array, $totallyDelete = null)
    {
        /** @var $item ActiveRecord */
        foreach ($array as $item) {
            if ($totallyDelete) {
                /** @var Field|Group $item */
                $item->delete($totallyDelete);
            } else {
                $item->delete();
            }
        }
        return true;
    }
}
