<?php

/* @var $this yii\web\View */

/* @var $model \common\models\material\Material */

use yii\helpers\Html;
use yii\helpers\Url;

$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]);
$this->title = $model->getValue(107);
?>
<div class="site-contact">
    <h2><?= Html::encode($model->title) ?></h2>
    <?= $model->getValue(110) ?>
    <hr>
    <? /** @var \common\models\material\Material $material */
    foreach ($model->getMaterials(55) as $material) : ?>
        <div class="region">
            <div class="row">
                <div class="col-md-5">
                    <h3><?= $material->title ?></h3>
                    <?= $material->getValue(112) ?>
                </div>
                <? if ($map = $material->getValue(113)) : ?>
                    <div class="col-md-7">
                        <div class="map">
                            <?= $map ?>
                        </div>
                    </div>
                <? endif; ?>
            </div>
        </div>
    <? endforeach; ?>
</div>
