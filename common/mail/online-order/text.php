<?php

/* @var $this yii\web\View */
/* @var $model array */

?>
<? if ($model['name']) : ?>
    Имя: <?= $model['name'] ?>,
<? endif; ?>

Телефон: <?= $model['phone'] ?>,

<? if ($model['email']) : ?>
    Электронная почта: <?= $model['email'] ?>,
<? endif; ?>

<? if ($model['body']) : ?>
    Комментарий: <?= $model['body'] ?>
<? endif; ?>


