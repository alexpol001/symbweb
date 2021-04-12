<?php

use common\models\material\Group;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $parent Group */
/* @var $parentController string */
/* @var $model Group */

$this->title = 'Разработка материалов';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['develop/group']];
\backend\components\Backend::getBreadCrumbGroup($this, $parent);
$this->params['breadcrumbs'][] = 'Добавить группу';
?>
    <h2><?= Html::encode(end($this->params['breadcrumbs'])) ?></h2>
<?= $this->render('element/_form', [
    'model' => $model,
    'parent' => $parent,
    'parentController' => $parentController,
]) ?>
