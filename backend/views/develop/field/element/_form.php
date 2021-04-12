<?php


use common\models\material\Field;
use kartik\widgets\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\models\material\Field */
/* @var $parent \common\models\material\Group */
/* @var $parentController string */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= \backend\widgets\FormWidget::widget([
        'creatable' => true,
        'copyable' => ($model->status != 100),
        'close' => [$parentController . '/update', 'id' => $parent ? $parent->id : $model->group_id, 'tab' => 'sub-field']
    ]) ?>

    <div class="form-content">

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <? if ($model->type !== 0) : ?>

            <?= $form->field($model, 'type')->widget(Select2::classname(), [
                'data' => Field::getTypes(),
                'options' => ['placeholder' => 'Выберите тип...', 'value' => $model->type ? $model->type : array_keys(Field::getTypes())[0]],
            ]) ?>

            <?= $form->field($model, 'default_value') ?>

            <?= $form->field($model, 'is_require', ['options' => ['class' => 'require-field', 'style' => ($model->type == 300) ? 'display: none;' : '']])->checkbox() ?>

            <?= $form->field($model, 'is_search', ['options' => ['class' => 'search-field', 'style' => !($model->type == 100 || $model->type == 400 || $model->type == 500 || $model->type == 1000 || $model->type == 1100) ? 'display: none;' : '']])->checkbox() ?>

            <?= $form->field($model, 'params', ['options' => ['class' => 'params-field', 'style' => !($model->type == 400 || $model->type == 500) ? 'display: none;' : '']])->textarea() ?>

        <? endif; ?>

        <?= $form->field($model, 'is_hidden')->checkbox() ?>

        <?
        if ($parent) {
            $model->group_id = $parent->id;
        }
        ?>

        <?= $form->field($model, 'group_id')->hiddenInput()->label(false); ?>
    </div>


    <?
    $script = <<<JS
var params = $('.params-field');
var require = $('.require-field');
var search = $('.search-field');
$('#field-type').on('change', function() {
    var val = $(this).val();
    if (val == 400 || val == 500) {
        params.show();
    } else {
        params.hide();
    }
    if (val != 300) {
        require.show();
    } else {
        require.hide();
    }
    if (val == 100 || val == 400 || val == 500 || val == 1000 || val == 1100) {
        search.show();
    } else {
        search.hide();
    }
});
JS;
    $this->registerJs(
        $script
    ) ?>
    <?php ActiveForm::end(); ?>
</div>
