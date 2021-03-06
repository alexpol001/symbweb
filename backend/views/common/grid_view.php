<?php

/* @var $model \common\models\material\Group|\common\models\material\Material|\common\models\material\Field */
/* @var $urlController string */
/* @var $additionalColumns array */

/* @var $subId int */
/* @var $fullStatuses int */

/* @var $create string */
/* @var $refresh string */
/* @var $delete string */

/* @var $searchModel \yii\db\ActiveRecord */

/* @var $dataProvider yii\data\ActiveDataProvider */

/* @var $title string */
/* @var $subClass string */


use backend\widgets\GridView;
use common\models\material\inherit\Common;
use kartik\popover\PopoverX;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?
$columns = [
    ['class' => 'kartik\grid\CheckboxColumn'],
    [
        'attribute' => 'title',
        'value' => function ($data, $key, $i) use ($urlController) {
            if (method_exists($data , 'isHiddenTitle') && $data->isHiddenTitle()) {
                return Html::a(Html::encode('Элемент ' . ($i + 1)), Url::to([$urlController . '/update', 'id' => $data->id]));
            } else {
                return Html::a(Html::encode($data->title), Url::to([$urlController . '/update', 'id' => $data->id]));
            }
        },
        'format' => 'html',
        'contentOptions' => ['class' => 'title'],
        'headerOptions' => ['class' => 'title']
    ],
];

if ($additionalColumns) {
    $columns = array_merge($columns, $additionalColumns);
}
$i = 0;
$columns = array_merge($columns, [
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'sort',
        'editableOptions' => [
            'header' => 'Порядок сортировки',
            'inputType' => \kartik\editable\Editable::INPUT_SPIN,
            'placement' => PopoverX::ALIGN_LEFT,
            'options' => [
                'pluginOptions' => ['min' => -1000000, 'max' => 1000000],
            ],
            'formOptions' => ['action' => [$urlController . '/edit']],
        ],
        'contentOptions' => ['class' => 'sort'],
        'headerOptions' => ['class' => 'sort']
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'status',
        'filter' => Common::getStatuses($fullStatuses ? true : false),
        'options' => ['id' => 'test'],
        'editableOptions' => [
            'header' => 'Статус',
            'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
            'placement' => PopoverX::ALIGN_LEFT,
            'data' => Common::getStatuses(($fullStatuses > 1) ? true : false),
            'displayValueConfig' => [
                '0' => 'Отключено',
                '10' => 'Включено',
                '100' => 'Обязательно',
            ],
            'formOptions' => ['action' => [$urlController . '/edit']],
        ],
        'contentOptions' => ['class' => 'status'],
        'headerOptions' => ['class' => 'status']
    ]]);

$grid_view = GridView::widget([
    'id' => md5($searchModel::className(). $searchModel->group_id),
    'title' => $title ? $title : 'Элементы',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $columns,
    'create' => $create,
    'refresh' => $refresh,
    'delete' => $delete,
]);
?>

<? if ($subId) : ?>
    <div style="display:none;" class="sub-grid<?=$subClass ? ' '.$subClass : ''?>" data-sub-id="#<?= $subId ?>">
        <?= $grid_view ?>
    </div>
<? else: ?>
    <?= $grid_view ?>
<? endif; ?>
