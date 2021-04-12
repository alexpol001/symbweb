<?php

/* @var $this yii\web\View */
/* @var \common\models\material\Material $model */
/* @var string $tags */

?>
<li class="portfolio-item wow fadeIn" data-wow-duration="1s">
    <a href="<?= \frontend\components\Frontend::getUrlPortfolio($model) ?>" class="portfolio-content">
        <img src="<?= $model->getValue(77) ?>" alt="Разработка сайта | <?= $model->title ?>">
        <h3 class="portfolio-title"><?= $model->title ?></h3>
        <div class="description">
            <h3><?= $model->title ?></h3>
            <div class="description-in">
                <?= $model->getValue(76) ?>
            </div>
            <? $color = $model->getValue(75) ?>
            <div style="<?= 'border:2px solid ' . $color ?>" class="show-case btn"
                 onmouseover="this.style.backgroundColor='<?= $color ?>'" onmouseout="this.style.backgroundColor=''">
                Посмотреть кейс
            </div>
        </div>
    </a>
</li>
