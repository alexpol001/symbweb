<?php

/* @var $model Group */

/* @var $subId int */

use common\models\material\Group;

?>
<?
$searchModel = new \common\models\material\search\Group();
$searchModel->setParent($model->id);
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
?>

<?= $this->render('/common/grid_view', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'subId' => $subId,
    'model' => $model,
    'create' => ['/develop/group/create', 'parent' => $model->id],
    'refresh' => ['', 'id' => $model->id, 'tab' => $subId],
    'delete' => ['/develop/group/multi-delete', 'parent' => $model->id, 'tab' => $subId],
    'fullStatuses' => 1,
    'urlController' => '/develop/group',
]); ?>
