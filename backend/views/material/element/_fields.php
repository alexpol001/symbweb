<?php

use backend\components\Backend;
use dominus77\iconpicker\IconPicker;
use dominus77\tinymce\TinyMce;
use kartik\color\ColorInput;
use kartik\date\DatePicker;
use mihaildev\elfinder\InputFile;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\material\Group */
/* @var $material \common\models\material\Material */
/* @var $form yii\widgets\ActiveForm */
?>

<? /** @var \common\models\material\Field $field */
foreach ($model->fields as $field) : ?>
    <? $valueField = "field[$field->id]"; ?>
    <? $fieldId = 'field' . $field->id ?>
    <? $form_group = true ?>
    <?
    $value = $material->getValue($field->id);
    $value = $value ? $value : $field->default_value;
    ?>
    <? switch ($field->type) {
        case 0:
            $material->setLabelTitle($field->title);
            if (!$field->is_hidden) {
                $valueField = $form->field($material, 'title')->textInput(['placeholder' => true, 'class' => 'form-control value-field']);
            } else {
                $valueField = $form->field($material, 'title', ['template' => '{input}', 'options' => ['tag' => false]])->hiddenInput(['value' => $model->parent->title])->label(false)->error(false);
            }
            $form_group = false;
            break;
        case 200:
            $valueField = Html::textarea($valueField, $value, ['class' => 'form-control value-field', 'id' => $fieldId, 'placeholder' => $field->title]);
            break;
        case 300:
            $valueField = TinyMce::widget([
                'name' => $valueField,
                'value' => $value,
                'options' => [
                    'rows' => 10,
                    'placeholder' => true,
                    'class' => 'form-control'
                ],
                'language' => 'ru',
                'clientOptions' => [
                    'menubar' => true,
                    'statusbar' => true,
                    'theme' => 'modern',
                    'plugins' => [
                        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars code fullscreen",
                        "insertdatetime media nonbreaking save table contextmenu directionality",
                        "template paste textcolor colorpicker textpattern imagetools codesample toc noneditable",
                    ],
                    'noneditable_noneditable_class' => 'fa',
                    'extended_valid_elements' => 'span[class|style]',
                    'toolbar1' => "undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                    'toolbar2' => "print preview media | forecolor backcolor emoticons | codesample",
                    'image_advtab' => true,
                ],
                'fileManager' => [
                    'class' => \dominus77\tinymce\components\MihaildevElFinder::className(),
                ],
            ]);
            break;
        case 400:
            $valueField = \kartik\select2\Select2::widget([
                'name' => $valueField,
                'data' => Backend::getSelectItems($field->params),
                'options' => ['placeholder' => $field->title, 'id' => $fieldId, 'class' => 'value-field'],
                'pluginOptions' => [
                    'allowClear' => (!$field->is_require)
                ],
                'value' => $value,
            ]);
            break;
        case 500:
            $valueField = \kartik\select2\Select2::widget([
                'name' => $valueField,
                'data' => Backend::getSelectItems($field->params),
                'options' => ['id' => $fieldId, 'multiple' => true, 'class' => 'value-field'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
                'value' => explode(", ", $value)
            ]);
            break;
        case 600:
            $valueField = InputFile::widget([
                'language' => 'ru',
                'controller' => 'elfinder',
                'template' => '<div class="input-group elfinder">{input}<span class="input-group-btn">{button}</span></div>',
                'options' => ['class' => 'form-control value-field', 'id' => $fieldId, 'placeholder' => $field->title],
                'buttonName' => '?????????????? ????????',
                'buttonOptions' => ['class' => 'btn btn-primary'],
                'name' => $valueField,
                'value' => $value,
            ]);
            break;
        case 700:
            $valueField = InputFile::widget([
                'language' => 'ru',
                'controller' => 'elfinder',
                'template' => '<div class="input-group elfinder">{input}<span class="input-group-btn">{button}</span></div>',
                'options' => ['class' => 'form-control value-field', 'id' => $fieldId, 'placeholder' => $field->title],
                'buttonName' => '?????????????? ??????????',
                'buttonOptions' => ['class' => 'btn btn-primary'],
                'name' => $valueField,
                'value' => $value,
                'multiple' => true
            ]);
            break;
        case 800:
            $valueField = ColorInput::widget([
                'options' => ['id' => $fieldId, 'class' => 'input-color value-field', 'placeholder' => '???????????????? ???????? ...'],
                'name' => $valueField,
                'value' => $value,
                'pluginOptions' => [
                    'preferredFormat' => 'rgb'
                ]
            ]);
            break;
        case 900:
            $valueField = IconPicker::widget([
                'options' => ['class' => 'form-control value-field', 'id' => $fieldId],
                'name' => $valueField,
                'value' => $value,
                'clientOptions' => [
                    'templates' => [
                        'popover' => '<div class="iconpicker-popover popover"><div class="arrow"></div><div class="popover-title"></div><div class="popover-content"></div></div>',
                        'footer' => '<div class="popover-footer"></div>',
                        'buttons' => '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button> <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',
                        'search' => '<input type="search" class="form-control iconpicker-search" placeholder="??????????" />',
                        'iconpicker' => '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
                        'iconpickerItem' => '<a role="button" href="#" class="iconpicker-item"><i></i></a>',
                    ],
                ]
            ]);
            break;
        case 1000:
            $valueField = DatePicker::widget([
                'name' => $valueField,
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'value' => $value,
                'options' => ['class' => 'value-field',],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy'
                ]
            ]);
            break;
        case 1100:
            $value = explode(", ", $value);
            $valueField = DatePicker::widget([
                'name' => ($valueField . '[0]'),
                'value' => $value[0],
                'type' => DatePicker::TYPE_RANGE,
                'options' => ['class' => 'value-field'],
                'options2' => ['class' => 'value-field'],
                'name2' => ($valueField . '[1]'),
                'value2' => $value[1],
                'separator' => '????',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy'
                ]
            ]);
            break;
        default:
            $valueField = Html::textInput($valueField, $value, ['class' => 'form-control value-field', 'id' => $fieldId, 'placeholder' => $field->title]);
    }

    ?>
    <? if ($form_group) {
        $valueField = '<div class="form-group"' . ($field->is_hidden ? ' style="display: none;">' : '>') . Html::label($field->title, $fieldId) . $valueField;
        $valueField .= $field->is_require ? '<div class="help-block"></div></div>' : '</div>';
    }
    ?>
    <?= $valueField ?>
<? endforeach; ?>
