<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\material\Field */
/* @var $parent \common\models\material\Group */
/* @var $parentController string */

$this->title = 'Разработка материалов';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['develop/group']];
\backend\components\Backend::getBreadCrumbGroup($this, $parent);
$this->params['breadcrumbs'][] = 'Добавить поле';
?>
    <h2><?= Html::encode(end($this->params['breadcrumbs'])) ?></h2>
<?= $this->render('element/_form', [
    'model' => $model,
    'parent' => $parent,
    'parentController' => $parentController,
]) ?>
