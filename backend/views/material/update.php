<?php

use backend\components\Backend;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $parentController string */
/* @var $model \common\models\material\Material */
/* @var $tab string */

$parent = $model->parent;
$this->title = Backend::getMaterialTitle($model->getMaterialParent(), $parent);;
if (!$parent->config) {
    Backend::getBreadCrumbMaterial($this, $model->getMaterialParent());
    $this->params['breadcrumbs'][] = 'Редактировать';
} else {
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<? if (!$parent->config) : ?>
    <h2><?= Html::encode(end($this->params['breadcrumbs'])) ?></h2>
<? endif; ?>
<?= $this->render('element/_form', [
    'model' => $model,
    'parentController' => $parentController,
    'tab' => $tab,
]) ?>
