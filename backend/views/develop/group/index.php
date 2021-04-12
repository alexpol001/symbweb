<?php
/* @var $this yii\web\View */
/* @var $searchModel \common\models\material\search\Group */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Разработка материалов';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('/common/grid_view', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'fullStatuses' => 2,
    'urlController' => '/develop/group',
    'title' => $this->title,
]); ?>
