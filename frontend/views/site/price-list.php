<?php

/* @var $this yii\web\View */

/* @var \common\models\material\Material $model */

use frontend\components\Frontend;
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]);
$this->title = $model->getValue(88);
?>
<div class="site-price-list">
    <h2><?= Html::encode($model->title) ?></h2>
    <? /** @var \common\models\material\Material $child */
    foreach ($model->getMaterials(43) as $child) :?>
        <p class="title-addition">
            <?= $child->title ?>
        </p>
        <table class="price-list-table">
            <tr>
                <th>Наименование</th>
                <th>Дополнительная информация</th>
                <th>Цена</th>
            </tr>
            <? /** @var \common\models\material\Material $price */
            foreach ($child->getMaterials(45) as $price) :?>
                <? $materials = $price->getMaterials(47) ?>
                <? if ($materials) : ?>
                <tr itemscope
                    itemtype="http://schema.org/Product" <?= $price->getValue(98) ? ' style="border-top: 2px solid ' . $price->getValue(98) . '"' : '' ?>>
                    <td itemprop="name" class="price-title" rowspan="<?= count($materials) ?>">
                        <?= $price->getValue(93) ?>
                    </td>
                    <? for ($i = 0; $i < count($materials); $i++) : ?>
                        <? /** @var \common\models\material\Material $material */
                        $material = $materials[$i] ?>
                        <? if ($i > 0) : ?>
                            <tr>
                        <? endif; ?>
                        <td<?= !$i ? ' itemprop="description"' : '' ?> class="price-desc">
                            <?= $material->getValue(95) ?>
                        </td>
                        <td<?= !$i ? ' itemprop="offers" itemscope itemtype="http://schema.org/Offer"' : '' ?>
                                class="price-value">
                            <? $price = $material->getValue(96); ?>
                            <?= !$i ? '<meta itemprop="priceCurrency" content="RUB"><meta itemprop="price" content="' . Frontend::getParsePrice($price) . '">' : '' ?>
                            <? if ($material->getValue(97)): ?>
                                <div class="old-price">
                                    <?= $material->getValue(97) ?>
                                </div>
                            <? endif; ?>
                            <div class="price">
                                <?= $price ?>
                            </div>
                        </td>
                        </tr>
                    <? endfor; ?>
                <? endif; ?>
            <? endforeach; ?>
        </table>
    <? endforeach; ?>
</div>
