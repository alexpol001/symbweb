<?php

/* @var $this yii\web\View */
/* @var \common\models\material\Material $model */

$this->title = $model->getValue(122);

use yii\helpers\Html; ?>
<div class="article">
    <h2><?= Html::encode($model->title) ?></h2>
    <hr>
    <?= $model->getValue(125) ?>
</div>
