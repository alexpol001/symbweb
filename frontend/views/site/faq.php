<?php

/* @var $this yii\web\View */

/* @var $model \common\models\material\Material */

use yii\helpers\Html;
use yii\helpers\Url;

$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]);
$this->title = $model->getValue(100);
?>
<div class="site-faq">
    <h2><?= Html::encode($model->title) ?></h2>
    <?= $model->getValue(103) ?>
    <hr>
    <? /** @var \common\models\material\Material $material */
    foreach ($model->getMaterials(51) as $material) : ?>
        <div itemscope itemtype="http://schema.org/Question" class="question-item">
            <h3 itemprop="name"><?= $material->title ?></h3>
            <div itemprop="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
                <div itemprop="text">
                    <?= $material->getValue(105) ?>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>
