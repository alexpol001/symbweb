<?php

namespace frontend\components;

use yii\base\Component;
use yii\helpers\Url;

class Frontend extends Component
{
    public static function getUrlPortfolio($model)
    {
        return Url::to(['site/portfolio', 'item' => $model->slug]);
    }

    public static function getUrlArticle($model)
    {
        return Url::to(['site/article', 'slug' => $model->slug]);
    }

    /**
     * @return string
     */
    public static function getSaleDate($type = null)
    {
        $timestamp = time();

        $month_number = date('n', $timestamp);


        switch ($month_number) {
            case 1:
                $day = 31;
                $month = 'Января';
                break;
            case 2:
                $day = 28;
                $month = 'Февраля';
                break;
            case 3:
                $day = 31;
                $month = 'Марта';
                break;
            case 4:
                $day = 30;
                $month = 'Апреля';
                break;
            case 5:
                $day = 31;
                $month = 'Мая';
                break;
            case 6:
                $day = 30;
                $month = 'Июня';
                break;
            case 7:
                $day = 31;
                $month = 'Июля';
                break;
            case 8:
                $day = 31;
                $month = 'Августа';
                break;
            case 9:
                $day = 30;
                $month = 'Сентября';
                break;
            case 10:
                $day = 31;
                $month = 'Октября';
                break;
            case 11:
                $day = 30;
                $month = 'Ноября';
                break;
            case 12:
                $day = 31;
                $month = 'Декабря';
                break;
        }

        /** @var $rus string */
        if ($type == 'day') return $day;
        if ($type == 'month') return $month;
        return $day . ' ' . $month;
    }

    public static function getParsePrice($price)
    {
        return preg_replace('~[^0-9]+~','',$price);
    }
}
