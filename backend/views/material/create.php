<?php

use backend\components\Backend;
use common\models\material\Material;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $parent \common\models\material\Group */
/* @var $parentController string */
/* @var $model \common\models\material\Material */
/* @var $tab string */

$materialParent = Material::findOne(Yii::$app->getRequest()->getQueryParams()['id']);
$this->title = Backend::getMaterialTitle($materialParent, $parent);
if (!$parent->config) {
    Backend::getBreadCrumbMaterial($this, $materialParent);
    $this->params['breadcrumbs'][] = 'Добавить';
} else {
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<? if (!$parent->config) : ?>
    <h2><?= Html::encode(end($this->params['breadcrumbs'])) ?></h2>
<? endif ?>
<?= $this->render('element/_form', [
    'model' => $model,
    'parent' => $parent,
    'parentController' => $parentController,
    'tab' => $tab,
]) ?>
