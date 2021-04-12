<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\material\Field */
/* @var $parentController string */

$this->title = 'Разработка материалов';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['develop/group']];
\backend\components\Backend::getBreadCrumbGroup($this, $model->parent);
$this->params['breadcrumbs'][] = 'Редактировать поле';
?>
    <h2><?= Html::encode(end($this->params['breadcrumbs'])) ?></h2>
<?= $this->render('element/_form', [
    'model' => $model,
    'parentController' => $parentController,
]) ?>
