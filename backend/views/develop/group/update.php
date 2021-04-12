<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $parent \common\models\material\Group */
/* @var $parentController string */
/* @var $model \common\models\material\Group */
/* @var $tab string */

$this->title = 'Разработка материалов';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['develop/group']];
\backend\components\Backend::getBreadCrumbGroup($this, $model->parent);
$this->params['breadcrumbs'][] = 'Редактировать группу';
?>
    <h2><?= Html::encode(end($this->params['breadcrumbs'])) ?></h2>
<?= $this->render('element/_form', [
    'model' => $model,
    'parentController' => $parentController,
    'tab' => $tab,
]) ?>
