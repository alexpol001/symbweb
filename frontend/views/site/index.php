<?php

/* @var $this yii\web\View */

/* @var Material $model */

use kv4nt\owlcarousel\OwlCarouselWidget;
use common\models\material\Material;
use yii\helpers\Url;
use frontend\assets\IndexAsset;


IndexAsset::register($this);
$this->registerLinkTag(['rel' => 'canonical', 'href' => 'http://symbweb.ru']);
$this->title = $model->getValue(22);
?>
<div class="site-index">
    <div class="slider hidden-xs">
        <?
        OwlCarouselWidget::begin([
            'container' => 'div',
            'containerOptions' => [
                'id' => 'slider-home',
            ],
            'pluginOptions' => [
                'autoplay' => true,
                'autoplayTimeout' => 6800,
                'autoplayHoverPause' => true,
                'items' => 1,
                'loop' => true,
                'smartSpeed' => 680,
                'nav' => true,
                'navText' => ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            ]
        ]);
        ?>
        <? $slider = $model->getMaterials(13) ?>
        <?
        /** @var Material $material */
        foreach ($slider as $material) : ?>
            <div class="slide" style="background-image: url(<?= $material->getValue(126); ?>)">
                <div class="slide-move-bg" style="background-image: url(<?= $material->getValue(127); ?>)"></div>
                <div class="container">
                    <div class="slide-image col-md-8 col-md-push-4">
                        <img src="<?= $material->getValue(27) ?>" alt="Разработка сайта | <?= $material->title ?>">
                    </div>
                    <div class="slide-text col-md-4 col-md-pull-8">
                        <div class="hidden-sm hidden-xs">
                            <h3>
                                <?= $material->title ?>
                            </h3>
                            <? /** @var Material $attribute */
                            foreach ($material->getMaterials(15) as $attribute) :?>
                                <p class="attribute">
                                    <span class="attribute-value"
                                          data-value="<?= $attribute->getValue(29) ?>"><?= $attribute->getValue(29) ?></span>
                                    <span class="attribute-name"><?= $attribute->title ?></span>
                                </p>
                            <? endforeach; ?>
                        </div>
                        <a class="show-case" href="<?= $material->getValue(26) ?>">Посмотреть
                            кейс</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        <? endforeach; ?>
        <? OwlCarouselWidget::end(); ?>
        <div class="gradient-line"></div>
    </div>
    <div class="container">
        <div class="service">
            <? $service = $model->getMaterials(17) ?>
            <h2 class="hidden-xs">Создание и продвижение сайтов<i class="fa <?= $model->getValue(40) ?>"></i></h2>
            <div class="service-item-wrap">
                <div class="service-line hidden-xs hidden-sm wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.3s"></div>
                <?
                foreach ($service as $i => $material) : ?>
                    <div class="service-item col-md-4">
                        <a href="<?= Url::to(['site/service', '#' => $material->getValue(32)]) ?>"
                           class="service-icon  wow zoomIn" data-wow-duration="0.5s" data-wow-delay="0.<?= $i ?>s">
                            <i class="fa <?= $material->getValue(33) ?>"></i>
                        </a>
                        <div class="wow fadeInUp" data-wow-duration="0.5s">
                            <h3 class="service-title">
                                <?= $material->title ?>
                            </h3>
                            <div class="service-description">
                                <?= $material->getValue(31) ?>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12 wow zoomIn"
                 data-wow-duration="0.5s">
                <div class="offer">
                    <a href="<?= Url::to(['site/service']) ?>" class="text-offer">
                        <?= $model->getValue(34) ?>
                    </a>
                    <p class="warning">
                        Внимание скидки действуют до <?= \frontend\components\Frontend::getSaleDate() ?>!
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="advantage" class="advantage fullscreen-element hidden-xs">
        <div class="container">
            <div class="advantages col-lg-5 col-md-6 col-sm-7 wow fadeInLeft" data-wow-duration="0.5s">
                <? $advantage = $model->getMaterials(19) ?>
                <h3 class="title">Наши преимущества</h3>
                <ul class="advantage-list">
                    <? /** @var Material $material */
                    foreach ($advantage as $material) : ?>
                        <li class="advantage-item" data-color="<?= $material->getValue(38) ?>">
                            <div class="advantage-icon">
                                <i class="fa <?= $material->getValue(39) ?>"></i>
                            </div>
                            <p class="advantage-title">
                                <?= $material->title ?>
                            </p>
                        </li>
                    <? endforeach; ?>
                </ul>
                <div class="border-right">
                </div>
            </div>
            <div class="advantage-info col-lg-7 col-md-6 col-sm-5 wow fadeInRight" data-wow-duration="0.5s">
                <? /** @var Material $material */
                foreach ($advantage as $material) : ?>
                    <div class="advantage-wrap">
                        <div class="advantage-text col-lg-6 col-md-7">
                            <div class="advantage-value">
                                <?= $material->getValue(36) ?>
                            </div>
                            <a class="online-order" style="background: <?= $material->getValue(38) ?>"
                               href="#" data-toggle="modal" data-target="#myModal">Онлайн заказ</a>
                        </div>
                        <div class="advantage-image col-lg-6 col-md-5 hidden-sm hidden-xs">
                            <img src="<?= $material->getValue(37) ?>" alt="<?= $material->title ?>">
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
    <div class="add-info">
        <div class="container">
            <p>Остались вопросы? Не уверены в своем решении?</p>
            <p>Позвоните нам, или оставьте заявку, кликнув по кнопке ниже.</p>
            <p>Наш менеджер свяжется с вами в ближайшее время.</p>
            <div class="wow zoomIn" data-wow-duration="0.5s">
                <a href="#" class="online-call" data-toggle="modal" data-target="#myModalCall">Оставить заявку</a>
            </div>
        </div>
    </div>
</div>
