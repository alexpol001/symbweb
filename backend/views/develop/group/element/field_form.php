<?php
/* @var $this yii\web\View */
/* @var $model Group */

/* @var $subId int */

use backend\widgets\GridView;
use common\models\material\Field;
use common\models\material\Group;

?>

<?
$searchModel = new \common\models\material\search\Field();
$searchModel->setParent($model->id);
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
?>
<?= $this->render('/common/grid_view', [
    'additionalColumns' => [
        [
            'attribute' => 'type',
            'filter' => Field::getTypes(true),
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Поиск по типу'],
            'format' => 'raw',
            'vAlign' => 'middle',
            'value' => function ($data) {
                return Field::getTypes(true)[$data->type];
            },
        ],
    ],
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'subId' => $subId,
    'model' => $model,
    'create' => ['/develop/field/create', 'parent' => $model->id],
    'refresh' => ['', 'id' => $model->id, 'tab' => $subId],
    'delete' => ['/develop/field/multi-delete', 'parent' => $model->id, 'tab' => $subId],
    'urlController' => '/develop/field',
    'fullStatuses' => 1
]); ?>

