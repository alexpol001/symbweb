<?php

namespace backend\components;


use Yii;
use yii\base\Component;

class Menu extends Component
{
    const HIDDEN_ELEMENTS = '0';

    private static function checkController($controller, $view)
    {
        return $controller === $view->context->getUniqueId();
    }

    private static function checkAction($controller, $action, $view)
    {
        return self::checkController($controller, $view) && Yii::$app->controller->action->id == $action;
    }

    private static function referenceMaterial($label, $parent, $view)
    {
        return [
            'label' => $label,
            'url' => ['material/index', 'parent' => $parent],
            'active' => self::checkController('material', $view) && \common\models\material\Material::isHaveParent($parent),
        ];
    }

    public static function getMenu($materials, $view, $full = false)
    {
        $items = [];
        /** @var \common\models\material\Material $material */
        foreach ($materials as $material) {
            if (($full && $material->getValue(5)) || in_array($material->id, explode(", ",self::HIDDEN_ELEMENTS))) {
                continue;
            }
            $icon = explode("fa-", $material->getValue(2))[1];
            $label = $material->title;
            $item = [
                'label' => $label,
                'icon' => $icon,
                'url' => '#',
            ];
            if ($controller = $material->getValue(3)) {
                $url = '/'.$controller;
                if ($action = $material->getValue(6)) {
                    $active = self::checkAction($controller, $action, $view);
                    $url .= '/' . $action;
                } else {
                    $active = self::checkController($controller, $view);
                }
                $item['url'] = [$url];
                if ($activeControllers = $material->getValue(20)) {
                    foreach (explode("|", $activeControllers) as $elem) {
                        if (!$active && self::checkController($elem, $view)) {
                            $active = true;
                            break;
                        }
                    }
                }
                $item['active'] = $active;
            } else if ($group_id = explode("_", $material->getValue(4))[1]) {
                $item = self::referenceMaterial($label, $group_id, $view);
                $item['icon'] = $icon;
            } else {
                $item['items'] = self::getMenu($material->getMaterialsByFieldValue(5, 'm_'.$material->id, [$material->id]), $view);
            }
            $items[] = $item;
        }
        return $items;
    }
}
