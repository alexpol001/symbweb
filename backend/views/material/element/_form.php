<?php

use common\models\material\Group;
use yii\bootstrap\Tabs;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model \common\models\material\Material */
/* @var $parentController string */
/* @var $form yii\widgets\ActiveForm */
/* @var $parent \common\models\material\Group */
/* @var $tab string */
?>

<?php $form = ActiveForm::begin(['id' => 'material-form', 'enableClientValidation' => false,]); ?>

<? if ($parent) {
    $model->group_id = $parent->id;
    echo $form->field($model, 'group_id', ['template' => '{input}', 'options' => ['tag' => false]])->hiddenInput()->label(false)->error(false);
    $model->material_id = Yii::$app->getRequest()->getQueryParams()['id'];
    echo $form->field($model, 'material_id', ['template' => '{input}', 'options' => ['tag' => false]])->hiddenInput()->label(false)->error(false);
}
?>

<?= \backend\widgets\FormWidget::widget([
    'creatable' => true,
    'copyable' => true,
    'onlySave' => $parent ? ($parent->config ? true : false) : ($model->parent->config ? true : false),
    'close' => ($model->material_id) ? [$parentController . '/update', 'id' => $model->getMaterialParent()->id, 'tab' => 'group' . ($parent ? $parent->id : $model->group_id)] : [$parentController, 'parent' => $model->parent->id]
]) ?>

<?
$items = [];
/** @var Group $group */
$groups = $parent ? $parent->groups : $model->parent->groups;
foreach ($groups as $key => $group) {
    if ($parent && $group->type == 100) continue;
    $tabId = 'group' . $group->id;
    $subTabId = "sub-" . $tabId;
    array_push($items, [
        'label' => $group->title,
        'content' => $group->fields ?
            $this->render('_fields', [
                'form' => $form,
                'model' => $group,
                'material' => $model
            ])
            : '',
        'options' => [
            'id' => $tabId
        ],
        'active' => ($tab == $tabId || (!$key && !$tab))
    ]);
}
?>

<?= Tabs::widget([
    'id' => 'tabs',
    'items' => $items
]);
?>

<?php ActiveForm::end(); ?>
<? if (!$parent) : ?>
    <? foreach ($groups as $group) {
        if ($group->type == 100) {
            echo $this->render('grid_form', [
                'model' => $group,
                'material' => $model,
                'subId' => 'group' . $group->id,
                'subClass' => $group->fields ? 'sub-field' : null,
            ]);
        }
    }
    ?>
<? endif; ?>
<? $this->registerJsFile(Yii::getAlias('@web') . '/js/sub-grid.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>
