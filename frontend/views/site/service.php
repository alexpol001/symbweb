<?php

/* @var $this yii\web\View */

/* @var Material $model */

use common\models\material\Material;
use frontend\components\Frontend;
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]);
$this->title = $model->getValue(42);
?>
<div class="site-service">
    <h2><?= Html::encode($this->title) ?></h2>
    <div id="creation" class="create-section service-section fullscreen-element">
        <div class="container">
            <? $service = $model->getMaterials(23) ?>
            <h3><?= $service[0]->parent->title ?></h3>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <? $materials = $service ?>
                    <? for ($i = 0; $i < count($materials); $i += 2) : ?>
                        <? /** @var Material $material */
                        $material = $materials[$i] ?>
                        <?= $this->render('element/service_item', [
                            'title' => $material->title,
                            'price' => $material->getValue(49),
                            'oldPrice' => $material->getValue(50),
                            'description' => $material->getValue(48),
                        ]) ?>
                    <? endfor; ?>
                </div>
                <div class="service-image col-lg-6 col-md-4 hidden-sm hidden-xs">
                    <img src="<?= $model->getValue(46) ?>" alt="<?= $service[0]->parent->title ?>">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <? for ($i = 1; $i < count($materials); $i += 2) : ?>
                        <? /** @var Material $material */
                        $material = $materials[$i] ?>
                        <?= $this->render('element/service_item', [
                            'title' => $material->title,
                            'price' => $material->getValue(49),
                            'oldPrice' => $material->getValue(50),
                            'description' => $material->getValue(48),
                        ]) ?>
                    <? endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="sale-section">
        <div class="container">
            <p class="period">Уникальные скидки действуют только до <span
                        class="date"><?= Frontend::getSaleDate('day') ?></span> <?= Frontend::getSaleDate('month') ?>!
            </p>
        </div>
    </div>
    <div class="circus-section fullscreen-element">
        <div class="container">
            <? $circus = $model->getMaterials(29) ?>
            <h3><?= $circus[0]->parent->title ?></h3>
            <div class="row">
                <? $materials = $circus ?>
                <? for ($i = 0; $i < count($materials); $i++) : ?>
                    <? /** @var Material $material */
                    $material = $materials[$i] ?>
                    <? if ($i % 2 == 0) : ?>
                        <div class="circus-wrap">
                    <? endif; ?>
                    <div class="col-md-5 col-sm-6 <?= ($i % 2 != 0) ? 'col-md-offset-2 ' : '' ?>circus-item">
                        <div class="circus-icon">
                            <i class="fa <?= $material->getValue(65) ?>"></i>
                        </div>
                        <p class="circus-title">
                    <span class="circus-number">
                        <?= ($i + 1) . '.' ?>
                    </span>
                            <?= $material->title ?>
                        </p>
                        <div class="circus-description">
                            <?= $material->getValue(64) ?>
                        </div>
                    </div>
                    <? if (($i % 2 != 0) || (($i + 1) >= (count($materials)))) : ?>
                        <div class="clearfix"></div>
                        </div>
                    <? endif; ?>
                <? endfor; ?>
            </div>
        </div>
    </div>
    <div class="sale-section">
        <div class="container">
            <p class="special">При заказе сайта доменное имя и <span class="date">2</span> месяца поддержки в <span
                        class="gift">подарок</span>!</p>
        </div>
    </div>
    <div id="seo" class="seo-section service-section fullscreen-element">
        <div class="container">
            <? $service = $model->getMaterials(25) ?>
            <h3><?= $service[0]->parent->title ?></h3>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <? $materials = $service ?>
                    <? for ($i = 0; $i < count($materials); $i += 2) : ?>
                        <? /** @var Material $material */
                        $material = $materials[$i] ?>
                        <?= $this->render('element/service_item', [
                            'title' => $material->title,
                            'price' => $material->getValue(53),
                            'oldPrice' => $material->getValue(54),
                            'description' => $material->getValue(52),
                        ]) ?>
                    <? endfor; ?>
                </div>
                <div class="service-image col-lg-6 col-md-4 hidden-sm hidden-xs">
                    <img src="<?= $model->getValue(56) ?>" alt="<?= $service[0]->parent->title ?>">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <? for ($i = 1; $i < count($materials); $i += 2) : ?>
                        <? /** @var Material $material */
                        $material = $materials[$i] ?>
                        <?= $this->render('element/service_item', [
                            'title' => $material->title,
                            'price' => $material->getValue(53),
                            'oldPrice' => $material->getValue(54),
                            'description' => $material->getValue(52),
                        ]) ?>
                    <? endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <div id="support" class="support-section service-section">
        <div class="container">
            <? $service = $model->getMaterials(27) ?>
            <h3><?= $service[0]->parent->title ?></h3>
            <div class="row">
                <? /** @var Material $material */
                foreach ($service as $material) :?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <?= $this->render('element/service_item', [
                            'title' => $material->title,
                            'price' => $material->getValue(59),
                            'oldPrice' => $material->getValue(60),
                            'description' => $material->getValue(58),
                        ]) ?>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>
