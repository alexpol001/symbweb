<?php

namespace backend\widgets;

use Yii;
use yii\helpers\Html;

class GridView extends \kartik\grid\GridView
{
    public $title;
    public $create;
    public $refresh;
    public $delete;

    public static function widget($config = [])
    {
        $buttons = '';
        if ($config['create'] !== false) {
            $buttons .= Html::a('<i class="fa fa-plus"></i>', $config['create'] ? $config['create'] : ['create'],
                    [
                        'class' => 'btn btn-success',
                        'title' => Yii::t('app', 'Добавить'),
                    ]) . ' ';
        }
        if ($config['refresh'] !== false) {
            $buttons .= Html::a('<i class="fa fa-refresh"></i>', $config['refresh'] ? $config['refresh'] : [''], [
                    'class' => 'btn btn-outline-secondary',
                    'title' => Yii::t('app', 'Сбросить'),
                    'data-pjax' => 0,
                ]) . ' ';
        }
        if ($config['delete'] !== false) {
            $buttons .= Html::a('<i class="fa fa fa-trash-o"></i>', $config['delete'] ? $config['delete'] : ['multi-delete'], [
                'class' => 'btn btn-danger',
                'title' => Yii::t('app', 'Удалить'),
                'onclick' => 'setParams($(this))',
                'data' => [
                    'confirm' => 'Вы действительно хотите удалить вабранные объекты?',
                    'method' => 'post',
                ],
            ]);
        }
        $config = array_merge([
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'pjax' => true,
            'toolbar' => [
                [
                    'content' => $buttons,
                    'options' => ['class' => 'btn-group mr-2']
                ],
                '{toggleData}',
            ],
            'toggleDataContainer' => ['class' => 'btn-group mr-2'],
            'export' => [
                'fontAwesome' => true
            ],
            'bordered' => true,
            'responsive' => false,
            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading' => "",
                'after' => false
            ],
            'persistResize' => false,
            'toggleDataOptions' => ['minCount' => 10],
            'exportConfig' => false,
        ], $config);
        return parent::widget($config); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        $this->panel['heading'] = $this->title ? $this->title : $this->view->title;
        parent::run(); // TODO: Change the autogenerated stub
        $this->view->registerJs($this->deleteScript(), \yii\web\View::POS_BEGIN);
    }

    private function deleteScript()
    {
        $script = <<<JS
        function setParams(e){
            var keyList = e.parents('.grid-view').yiiGridView('getSelectedRows');
            if(keyList != '') {
                e.attr('data-params', JSON.stringify({keyList}));
            } else {
                e.removeAttr('data-params');
            }
        };
JS;
        return $script;
    }
}