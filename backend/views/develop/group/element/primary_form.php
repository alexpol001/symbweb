<?php

/* @var $parent Group */
/* @var $model Group */

/* @var $form yii\widgets\ActiveForm */

use common\models\material\Group;
use kartik\widgets\Select2; ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<? if (!$parent && !$model->group_id) : ?>
    <? $model->is_require = $model->status == 100 ? 1 : 0 ?>

    <? $model->is_config = $model->config ? 1 : 0 ?>

    <?= $form->field($model, 'is_require')->checkbox() ?>

    <?= $form->field($model, 'is_config')->checkbox() ?>

    <?
    $model->type = 100;
    echo $form->field($model, 'type')->hiddenInput()->label(false);
    ?>
<? elseif ($model->status != 100) : ?>
    <?= $form->field($model, 'type')->widget(Select2::classname(), [
        'data' => Group::getTypes(),
        'options' => ['placeholder' => 'Выберите тип...', 'value' => $model->type ? $model->type : 0],
    ]) ?>
<? else : ?>
    <?
    $model->type = 0;
    echo $form->field($model, 'type')->hiddenInput()->label(false);
    ?>
<? endif; ?>

<?
if (!$model->id) {
    $model->group_id = $parent ? $parent->id : 0;
}
?>

<?= $form->field($model, 'group_id')->hiddenInput()->label(false); ?>
