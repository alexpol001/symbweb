<?php
/* @var $this yii\web\View */
/* @var $title string */
/* @var $price string */
/* @var $oldPrice string */

/* @var $description string */

use frontend\components\Frontend;

?>
<div itemscope itemtype="http://schema.org/Product" class="service-item">
    <a><span itemprop="name"><?= $title ?></span></a>
    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="prices">
        <meta itemprop="priceCurrency" content="RUB">
        <meta itemprop="price" content="<?= Frontend::getParsePrice($price) ?>">
        <div class="price">
            <?= $price ?>
        </div>
        <div class="old-price">
            <?= $oldPrice ?>
        </div>
    </div>
    <div itemprop="description" class="description">
        <?= $description ?>
    </div>
</div>
