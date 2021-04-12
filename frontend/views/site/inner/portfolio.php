<?php

/* @var $this yii\web\View */
/* @var $portfolio \common\models\material\Material */
/* @var $model \common\models\material\Material */

/* @var $recommend array */

use yii\helpers\Html;

$portfolioTitle = $portfolio->title;
$portfolioItemTitle = $model->title;
$this->title = $portfolioTitle . ' - ' . $portfolioItemTitle;
?>
<div class="site-inner-portfolio">
    <div class="container">
        <h2><?= Html::encode($portfolioTitle) ?></h2>
        <?= $portfolio->getValue(70) ?>
        <hr>
    </div>
    <div class="port-sec fullscreen-element">
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-1 col-sm-6 col-xs-12 col-lg-push-5 col-sm-push-6">
                    <div class="port-image">
                        <img src="<?= $model->getValue(79) ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-5 col-sm-6 col-xs-12 col-lg-pull-7 col-sm-pull-6">
                    <h3>
                        <?= $portfolioItemTitle ?>
                    </h3>
                    <div class="port-desc">
                        <?= $model->getValue(80) ?>
                        <div class="port-client-result">
                            <? /** @var \common\models\material\Material $attribute */
                            foreach ($model->getMaterials(39) as $attribute) : ?>
                                <div class="attribute-item">
                                    <div class="attribute-value">
                                        <?= $attribute->getValue(85) ?>
                                    </div>
                                    <div class="attribute-name">
                                        <?= $attribute->title ?>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        </div>
                        <a class="online-order" style="background-color: <?= $model->getValue(75) ?>" href="#"
                           data-toggle="modal" data-target="#myModal">
                            Хочу такой же!
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="order-detail">
                <div class="col-md-6 wow fadeInLeft" data-wow-duration="0.5s">
                    <h3>Клиент</h3>
                    <div class="order-client">
                        <?= $model->getValue(81) ?>
                    </div>
                    <a class="site-url-value" href="<?= $model->getValue(83) ?>"
                       style="color: <?= $model->getValue(75) ?>" target="_blank">
                        <?= $model->getValue(83) ?>
                    </a>
                </div>
                <div class="col-md-6 wow fadeInRight" data-wow-duration="0.5s">
                    <h3>Задача</h3>
                    <div class="order-problem">
                        <?= $model->getValue(82) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="portfolio-inner-content">
            <?= $model->getValue(78) ?>
        </div>
        <div class="site-url">
            <a class="value" href="<?= $model->getValue(83) ?>" target="_blank">
                <?= $model->getValue(83) ?>
            </a>
            <a class="online-order" href="#" data-toggle="modal" data-target="#myModal">
                Хочу такой же!
            </a>
        </div>
        <div class="projects">
            <h3>Другие наши проекты</h3>
            <div class="site-portfolio">
                <?=
                $this->render('../section/portfolio_list', [
                    'materials' => $recommend
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
