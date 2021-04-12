<?php

/* @var $model \common\models\material\Group */
/* @var $material \common\models\material\Material */
/* @var $subId int */
/* @var $subClass string */

?>
<?
$searchModel = new \common\models\material\search\Material();
$searchModel->setParent($model->id, $material->id);
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
?>
<?= $this->render('/common/grid_view', [
    'additionalColumns' => \backend\components\Backend::getSearchColumns($searchModel->group_id),
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'subId' => $subId,
    'model' => $material,
    'create' => ['create', 'id' => $material->id, 'parent' => $model->id],
    'refresh' => ['', 'id' => $material->id, 'tab' => $subId],
    'delete' => ['/material/multi-delete', 'parent' => $material->id, 'tab' => $subId],
    'urlController' => '/material',
    'subClass' => $subClass,
]); ?>
