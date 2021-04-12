<?php

use common\models\material\Group;

/* @var $this yii\web\View */
/* @var $searchModel \common\models\material\search\Material */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Group::findOne($searchModel->group_id)->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/common/grid_view', [
    'additionalColumns' => \backend\components\Backend::getSearchColumns($searchModel->group_id),
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'urlController' => '/material',
    'title' => $this->title,
    'create' => ['create', 'parent' => $searchModel->group_id],
    'refresh' => ['', 'parent' => $searchModel->group_id],
    'delete' => ['multi-delete', 'parent' => $searchModel->group_id],
]); ?>
